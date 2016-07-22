<?php
namespace App\Models;

use Cache;
use DB;

class OauthClient extends Model
{
    protected static $_clientData = array();
    protected $table = 'oauth_clients';

    public $incrementing = false;

    public static function getClientData($id)
    {
        $data = isset(static::$_clientData) ? static::$_clientData[$id] : null;
        if ((null === $data) && null === $data = Cache::get($cacheKey = 'oauth.client.' . $id)) {
            $data = false;
            if ($client = static::where('id', $id)->first()) {
                $data = $client->getAttributes();
                if ($endpoint = $client->oauthEndpoint) {
                    $data['endpoint'] = $endpoint->redirect_uri;
                }
                $data['scopes'] = $data['raw_scopes'] = array();
                if ($scopes = $client->scopes) foreach ($scopes as $scope) {
                    $data['scopes'][$scope->scope] = $scope->description;
                    $data['raw_scopes'][$scope->id] = $scope->getAttributes();
                    $data['raw_scopes'][$scope->id]['scope_id'] = $scope->id;
                }
            }
            Cache::forever($cacheKey, $data);
            static::$_clientData[$id] = $data;
        }
        return $data;
    }

    public function endpoint()
    {
        return $this->hasOne('App\Models\OauthClientEndpoint', 'client_id');
    }

    public function scopes()
    {
        return $this->belongsToMany('App\Models\OauthScope', 'oauth_client_scopes', 'client_id', 'scope_id');
    }

    public function grants()
    {
        return $this->belongsToMany('App\Models\OauthGrant', 'oauth_client_grants', 'client_id', 'grant_id');
    }

    public function save(array $options = array())
    {
        Cache::forget('oauth.client.' . $id = $this->id);
        unset(static::$_clientData[$id]);
        return parent::save($options);
    }

    public function saveEndpoint($redirectUri)
    {
        $oauthEndpoint = $this->endpoint;
        if (is_null($oauthEndpoint)) {
            $oauthEndpoint = new OauthClientEndpoint();
        }
        $oauthEndpoint->client_id = $this->id;
        $oauthEndpoint->redirect_uri = !empty($redirectUri) ? $redirectUri : $oauthEndpoint->redirect_uri;
        $this->endpoint()->save($oauthEndpoint);
    }

    public function saveScope($scopes)
    {
        $oldScopes = $this->scopes;
        foreach ($oldScopes as $scope) {
            $this->scopes()->detach($scope->id);
        }
        if ($scopes) {
            foreach ($scopes as $scopeId) {
                $this->scopes()->attach($scopeId);
            }
        }
    }

    public function saveGrant($grants)
    {
        $oldGrants = $this->grants;
        foreach ($oldGrants as $oldGrant) {
            $this->grants()->detach($oldGrant->id);
        }
        if ($grants) {
            foreach ($grants as $grantId) {
                $this->grants()->attach($grantId);
            }
        }
    }

}

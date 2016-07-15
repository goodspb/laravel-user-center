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
        return $this->hasOne('OauthClientEndpoint', 'client_id');
    }

    public function scopes()
    {
        return $this->belongsToMany('OauthScope', 'oauth_client_scopes', 'client_id', 'scope_id');
    }

    public function save(array $options = array())
    {
        Cache::forget('oauth.client.' . $id = $this->id);
        unset(static::$_clientData[$id]);
        return parent::save($options);
    }

    public function saveEndpoint($input)
    {
        $oauthEndpoint = $this->oauthEndpoint;
        if (is_null($oauthEndpoint)) {
            $oauthEndpoint = new OauthClientEndpoint();
        }
        $oauthEndpoint->client_id = $this->id;
        $oauthEndpoint->redirect_uri = !empty($input['redirect_uri']) ? $input['redirect_uri'] : $oauthEndpoint->redirect_uri;
        $this->oauthEndpoint()->save($oauthEndpoint);
    }

    public function saveScope($input)
    {
        $oldScopes = $this->scopes;
        foreach ($oldScopes as $scope) {
            $this->scopes()->detach($scope->id);
        }
        $scopes = $input['scopes'];
        if ($scopes) {
            $scopeArr = explode(",", $scopes);
            foreach ($scopeArr as $name) {
                $scopeId = DB::table('oauth_scopes')->where('name', $name)->pluck('id');
                if ($scopeId) {
                    $this->scopes()->attach($scopeId);
                }
            }

        }
    }

}
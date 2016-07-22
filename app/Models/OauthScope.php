<?php
namespace App\Models;


class OauthScope extends Model
{
    protected $table = 'oauth_scopes';

    public function clients()
    {
        return $this->belongsToMany('OauthClient', 'oauth_client_scopes', 'scope_id', 'client_id');
    }

}

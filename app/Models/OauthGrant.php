<?php
namespace App\Models;


class OauthGrant extends Model
{
    protected $table = 'oauth_grants';

    public function clients()
    {
        return $this->belongsToMany('OauthClient', 'oauth_client_grants', 'grant_id', 'client_id');
    }

}

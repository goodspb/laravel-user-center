<?php
namespace App\Http\Controllers\Admin\Oauth;


use App\Http\Controllers\Admin\BaseController;

class GrantController extends BaseController
{

    public function getIndex()
    {
        return redirect('admin/oauth/grant/list');
    }

    public function getList()
    {
        return $this->getBaseList('OauthGrant', 'admin.oauth.grant.list');
    }

}

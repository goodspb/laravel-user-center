<?php
namespace App\Http\Controllers\Admin\Oauth;

use App\Http\Controllers\Admin\BaseController;
use App\Models\OauthScope;
use Illuminate\Http\Request;

class ClientController extends BaseController
{

    public function getList()
    {
        return $this->getBaseList('oauthClient', 'admin.oauth.client.list');
    }

    public function getAdd()
    {
        $this->getAllScopes();
        return view('admin.oauth.client.item');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'oauth_client_id' => 'required|max:40',
            'oauth_client_secret' => 'required|max:40',
            'oauth_client_name' => 'required|max:255',
            'oauth_client_redirect_uri' => 'required|url',
            'oauth_client_scope' => 'required|array'
        ]);
        $oauthClient = $this->getBaseItem('oauthClient');
        
    }

    public function getEdit($id)
    {
        $this->getAllScopes();
        return $this->getBaseItem('oauthClient', $id, 'admin.oauth.client.item');
    }

    protected function getAllScopes()
    {
        $scopes = OauthScope::all();
        view()->share('scopes', $scopes);
        return $scopes;
    }

}
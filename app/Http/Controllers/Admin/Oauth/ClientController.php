<?php
namespace App\Http\Controllers\Admin\Oauth;

use App\Http\Controllers\Admin\BaseController;
use App\Models\OauthClient;
use App\Models\OauthGrant;
use App\Models\OauthScope;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ClientController extends BaseController
{

    public function getIndex()
    {
        return $this->redirect('admin/oauth/client/list');
    }

    public function getList()
    {
        return $this->getBaseList('oauthClient', 'oauth.client.list');
    }

    public function getAdd()
    {
        $this->getAllScopes();
        $this->getAllGrant();
        return $this->render('oauth.client.item');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'oauth_client_id' => 'required|max:40',
        ]);
        $oauthClient = new OauthClient();
        $oauthClient->id = Input::get('oauth_client_id');
        return $this->saveClient($oauthClient, $request);
    }

    public function getEdit($id)
    {
        $this->getAllScopes();
        $this->getAllGrant();
        return $this->getBaseItem('oauthClient', $id, 'oauth.client.item');
    }

    public function postEdit(Request $request)
    {
        $oauthClient = $this->getBaseItem('oauthClient', Input::get('id'));
        return $this->saveClient($oauthClient, $request);
    }

    protected function saveClient($client, Request $request)
    {
        $this->validate($request, [
            'oauth_client_secret' => 'required|max:40',
            'oauth_client_name' => 'required|max:255',
            'oauth_client_redirect_uri' => 'required|url',
            'oauth_client_scope' => 'required|array',
            'oauth_client_grant' => 'array',
        ]);
        /** @var OauthClient $client */
        $client->secret = Input::get('oauth_client_secret');
        $client->name = Input::get('oauth_client_name');
        $type = $client->isNew() ? 'add' : 'edit';
        if ($client->save()) {
            $client->saveEndpoint(Input::get('oauth_client_redirect_uri'));
            $client->saveScope(Input::get('oauth_client_scope'));
            $client->saveGrant(Input::get('oauth_client_grant'));
            return $this->successReturn(trans("common.{$type}_success"));
        }
        return $this->errorReturn(trans("common.{$type}_fail"));
    }

    protected function getAllScopes()
    {
        $scopes = OauthScope::all();
        $this->assign('scopes', $scopes);
        return $scopes;
    }

    protected function getAllGrant()
    {
        $grants = OauthGrant::all();
        $this->assign('grants', $grants);
        return $grants;
    }

    public function postDelete()
    {
        return $this->doDelete('OauthClient');
    }

}

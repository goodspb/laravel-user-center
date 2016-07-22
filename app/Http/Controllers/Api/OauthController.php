<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Authorizer;
use View;
use Auth;
use Request;
use Redirect;

class OauthController extends Controller
{
    public function getAuthorize()
    {
        $authParams = Authorizer::getAuthCodeRequestParams();
        $formParams = array_except($authParams, 'client');
        $formParams['client_id'] = $authParams['client']->getId();
        $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope) {
            return $scope->getId();
        }, $authParams['scopes']));
        return View::make('oauth.authorization-form', ['params' => $formParams, 'client' => $authParams['client']]);
    }

    public function postAuthorize()
    {
        $params = Authorizer::getAuthCodeRequestParams();
        $params['user_id'] = Auth::user()->id;
        $redirectUri = '/';
        // If the user has allowed the client to access its data, redirect back to the client with an auth code.
        if (Request::has('approve')) {
            $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
        }
        // If the user has denied the client to access its data, redirect back to the client with an error message.
        if (Request::has('deny')) {
            $redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();
        }
        return Redirect::to($redirectUri);
    }

    public function verifyPasswordGrant($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];
        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }
        return false;
    }
}

<?php
namespace App\Http\Controllers\Admin\Oauth;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\Models\OauthScope;
use Illuminate\Support\Facades\Input;

class ScopeController extends BaseController
{
    public function getIndex()
    {
        return $this->redirect('admin/oauth/scope/list');
    }

    public function getList()
    {
        return $this->getBaseList('oauthScope', 'oauth.scope.list');
    }

    public function getAdd()
    {
        return $this->render('oauth.scope.item');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'oauth_scope_id' => 'required|max:40',
        ]);
        $scope = new OauthScope();
        $scope->id = Input::get('oauth_scope_id');
        return $this->saveScope($scope, $request);
    }

    public function getEdit($id)
    {
        return $this->getBaseItem('oauthScope', $id, 'oauth.scope.item');
    }

    public function postEdit(Request $request)
    {
        $scope = $this->getBaseItem('oauthScope', Input::get('id'));
        return $this->saveScope($scope, $request);
    }

    protected function saveScope($scope, Request $request)
    {
        $this->validate($request, [
            'oauth_scope_description' => 'required|max:255',
        ]);
        $scope->description = Input::get('oauth_scope_description');
        $type = $scope->isNew() ? 'add' : 'edit';
        if ($scope->save()) {
            return $this->successReturn(trans("common.{$type}_success"));
        }
        return $this->errorReturn(trans("common.{$type}_fail"));
    }

    public function postDelete()
    {
        return $this->doDelete('oauthScope');
    }

}

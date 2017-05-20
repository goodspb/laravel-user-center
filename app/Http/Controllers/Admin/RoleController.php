<?php
namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use Input, Exception, Response;
use App\Models\Role;

class RoleController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->assign('type', 'role');
    }

    public function getList()
    {
        return $this->getBaseList('role', 'entrust.list');
    }

    public function getEdit($id)
    {
        return $this->getBaseItem('role', $id, 'entrust.item');
    }

    public function postEdit(Request $request)
    {
        $role = $this->getBaseItem('role', Input::get('id'));
        return $this->saveRole($role, $request);
    }

    public function getAdd()
    {
        return $this->render('entrust.item');
    }

    public function postAdd(Request $request)
    {
        $this->validate($request, [
            'role_name' => 'required|alpha',
        ]);
        $role = new Role();
        $role->name = Input::get('role_name');
        return $this->saveRole($role, $request);
    }

    protected function saveRole($role, Request $request)
    {
        $this->validate($request, [
            'role_display_name'  => 'required',
            'role_description'   => 'required'
        ]);
        $role->display_name = Input::get('role_display_name');
        $role->description = Input::get('role_description');
        $type = $role->isNew() ? 'add' : 'edit';
        if ($role->save()) {
            return $this->successReturn(trans("common.{$type}_success"));
        }
        return $this->errorReturn(trans("common.{$type}_fail"));
    }

    public function postDelete()
    {
        return $this->doDelete('role');
    }

    public function getPermission($id)
    {
        /** @var Role $role */
        $role = $this->getBaseItem('role', $id);
        $permissions = Permission::all();
        return $this->render('role.permission', compact('permissions', 'role'));
    }

    public function postPermission(Request $request)
    {
        try {
            $role = $this->getBaseItem('role', Input::get('id'));
            $this->validate($request, [
                'perms' => 'array'
            ]);
            $role->savePermissions(Input::get('perms'));
            if ($role->save()) {
                return Response::json(['status' => 1, 'msg'=> trans('common.save_success')]);
            }
            return Response::json(['status' => 0, 'msg'=> trans('common.save_fail')]);
        } catch (Exception $e) {
            return Response::json(['status' => 0, 'msg'=> trans('common.save_fail')]);
        }
    }
}

<?php
namespace App\Http\Controllers\Admin;

use App\Models\Region;
use App\Models\Role;
use Input, Response, Exception;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends BaseController
{

    public function getList()
    {
        $users = User::query()->leftjoin('user_profiles as up', 'up.user_id', '=', 'users.id');
        $inputs = Input::all();
        foreach ($inputs as $inputKey => $inputValue) {
            if ($inputValue !== '' && $inputKey != 'page') {
                $users = $users->where($inputKey, 'LIKE', '%' . $inputValue . '%');
            }
        }
        $users = $users->orderBy('id', 'DESC')->paginate(10);
        return view('admin.user.list', compact('users'));
    }

    public function getAdd()
    {
        $this->getAllRoles();
        $this->getRegionProvinces();
        return view('admin.user.item');
    }

    public function postAdd(Request $request)
    {
        $user = new User();
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);
        $user->username = Input::get('username');
        $user->email = Input::get('email');
        return $this->saveUser($user, $request);
    }

    public function getEdit($id)
    {
        $this->getAllRoles();
        $this->getRegionProvinces();
        return $this->getBaseItem('user', $id, 'admin.user.item');
    }

    public function postEdit(Request $request)
    {
        $user = $this->getBaseItem('user', Input::get('id'));
        return $this->saveUser($user, $request);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    protected function saveUser($user, Request $request)
    {
        $this->validate($request, [
            'mobile' => 'digits:11',
            'nickname' => 'max:256',
            'description' => 'max:1000',
            'sex' => 'digits_between:0,2',
            'password' => 'confirmed|min:6',
            'roles' => 'array',
            'province' => 'digits_between:1,4000',
            'city' => 'digits_between:1,4000',
            'area' => 'digits_between:1,4000',
        ]);
        $password = Input::get('password', '');
        if (!empty($password)) {
            $user->password = bcrypt($password);
        }
        $user->mobile = Input::get('mobile', '');
        $isNew = $user->isNew();
        $type = $isNew ? 'add' : 'edit';
        if ($user->save()) {
            $user->saveProfile(Input::all());
            $user->saveRoles(Input::get('roles'));
            return redirect()->back()->with('success', trans("common.{$type}_success"));
        }
        return redirect()->back()->withErrors(['error' => trans("common.{$type}_fail")]);
    }

    public function postAvatar($id)
    {
        return $this->updateAvatar($id > 0 ? intval($id) : $this->authUser['id']);
    }

    public function postDelete()
    {
        return $this->doDelete('user');
    }

    protected function getAllRoles()
    {
        $roles = Role::all();
        view()->share('roles', $roles);
        return $roles;
    }

    public function getRegion()
    {
        $type = intval(Input::get('type', 0));
        $pid = intval(Input::get('pid', 0));
        if ($pid <= 0) {
            return Response::json(array(
                'status' => -1,
                'error' => 'param pid is not found'
            ));
        }
        return Response::json(array(
            'status' => 0,
            'list' => (new Region())->getByPid($pid, $type)
        ));

    }

    /**
     * @param int $type 0:省; 1:市; 2:区
     * @param null $viewKey
     * @return mixed
     */
    protected function getRegionProvinces()
    {
        $result = (new Region)->getProvinces();
        view()->share('provinces', $result);
        return $result;
    }
}

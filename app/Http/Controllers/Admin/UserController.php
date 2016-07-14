<?php
namespace App\Http\Controllers\Admin;

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
        view()->share('roles', Role::all());
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
        $user->fill(Input::all());
        return $this->saveUser($user, $request);
    }

    public function getEdit($id)
    {
        view()->share('roles', Role::all());
        return $this->getBaseItem('user', $id, 'admin.user.item');
    }

    public function postEdit(Request $request)
    {
        $user = $this->getBaseItem('user', Input::get('id'));
        return $this->saveUser($user, $request);
    }

    protected function saveUser($user, Request $request)
    {
        $this->validate($request, [
            'mobile' => 'digits:11',
            'nickname' => 'max:256',
            'description' => 'max:1000',
            'sex' => 'required|digits_between:0,2',
            'avatar' => 'required',
            'password' => 'confirmed|min:6',
            'roles' => 'array',
        ]);
        $password = Input::get('password', '');
        if (!empty($password)) {
            $user->password = bcrypt($password);
        }
        $user->mobile = Input::get('mobile', '');
        $isNew = $user->isNew();
        $type = $isNew ? 'add' : 'edit';
        $isNew or $user->saveRoles(Input::get('roles'));
        if ($user->save()) {
            $isNew and $user->saveRoles(Input::get('roles'), true);
            $user->saveProfile(Input::all());
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
}

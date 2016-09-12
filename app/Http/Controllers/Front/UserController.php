<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Common\RegionController;
use App\Http\Controllers\Common\AvatarController;
use App\Models\User;
use Illuminate\Http\Request;
use Input;

class UserController extends BaseController
{
    use RegionController, AvatarController;

    public function getIndex()
    {
        return view('front.user.index');
    }

    public function getProfile()
    {
        $this->getRegionProvinces();
        $item = $this->authUser;
        return view('front.user.profile', ['item' => $item]);
    }

    public function postProfile(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'digits:11',
            'nickname' => 'max:256',
            'description' => 'max:1000',
            'sex' => 'digits_between:0,2',
            'password' => 'confirmed|min:6',
            'province' => 'digits_between:1,4000',
            'city' => 'digits_between:1,4000',
            'area' => 'digits_between:1,4000',
        ]);
        /** @var User $user */
        $user = User::find($this->authUser['id']);
        $password = Input::get('password', '');
        if (!empty($password)) {
            $user->password = bcrypt($password);
        }
        $user->mobile = Input::get('mobile', '');
        if ($user->save()) {
            $user->saveProfile(Input::all());
            return redirect()->back()->with('success', trans("common.edit_success"));
        }
        return redirect()->back()->withErrors(['error' => trans("common.edit_fail")]);
    }

    public function postAvatar()
    {
        return $this->updateAvatar($this->authUser['id']);
    }

}

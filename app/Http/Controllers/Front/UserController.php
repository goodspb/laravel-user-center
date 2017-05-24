<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Common\RegionController;
use App\Http\Controllers\Common\AvatarController;
use App\Models\User;
use Illuminate\Http\Request;
use Input;

class UserController extends BaseAuthController
{
    use RegionController, AvatarController;

    public function getIndex()
    {
        return $this->render('user.index');
    }

    public function getProfile()
    {
        $this->getRegionProvinces();
        $item = $this->authUser;
        return $this->render('user.profile', ['item' => $item]);
    }

    public function postProfile(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'digits:11',
            'nickname' => 'max:255',
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
            return $this->successReturn(trans("common.edit_success"));
        }
        return $this->errorReturn(trans("common.edit_fail"));
    }

    public function postAvatar()
    {
        return $this->updateAvatar($this->authUser['id']);
    }

}

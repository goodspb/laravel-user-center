<?php

namespace App\Http\Controllers\Api\Resource;

use Illuminate\Http\Request;
use Authorizer;
use Input;
use App\Models\User;

class ProfileController extends BaseResourceController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uid = Authorizer::getResourceOwnerId();
        $user = User::find($uid);
        return $this->apiReturn(true, 1, '', $user->getInfo());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = Input::all();
        unset($inputs['access_token']);
        if (empty($inputs)) {
            return $this->apiReturn(false, 0, 'empty params');
        }
        $this->validate($request, [
            'nickname' => 'max:256',
            'description' => 'max:1000',
            'sex' => 'digits_between:0,2',
            'province' => 'digits_between:1,4000',
            'city' => 'digits_between:1,4000',
            'area' => 'digits_between:1,4000',
        ]);
        $uid = Authorizer::getResourceOwnerId();
        $user = User::find($uid);
        $profile = $user->profile;
        isset($inputs['nickname']) and $profile->nickname = $inputs['nickname'];
        isset($inputs['description']) and $profile->description = $inputs['description'];
        isset($inputs['sex']) and $profile->sex = $inputs['sex'];
        isset($inputs['province']) and $profile->province = $inputs['province'];
        isset($inputs['city']) and $profile->city = $inputs['city'];
        isset($inputs['area']) and $profile->area = $inputs['area'];
        $result = $user->profile()->save($profile);
        return $this->apiReturn($result ? true : false, $result ? 1 : 0);
    }
}

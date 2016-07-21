<?php

namespace App\Http\Controllers\Api\Resource;

use App\Library\ErrorCode;
use App\Models\User;
use Illuminate\Http\Request;
use Authorizer;
use Input;

class PasswordController extends BaseResourceController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'original_password' => 'required|min:6',
            'password' => 'required|min:6',
        ]);
        $uid = Authorizer::getResourceOwnerId();
        $user = User::find($uid);
        /** @var \Illuminate\Hashing\BcryptHasher $hasher */
        $hasher = app('hash');
        if (!$hasher->check(Input::get('original_password'), $user->password)) {
            return $this->apiReturn(false, ErrorCode::ORIGIN_PASSWORD_IS_WRONG, trans('error_code.'.ErrorCode::ORIGIN_PASSWORD_IS_WRONG));
        }
        $user->password = $hasher->make(Input::get('password'));
        if ($user->save()) {
            return $this->apiReturn(true, 1);
        }
        return $this->apiReturn(false, ErrorCode::DB_SAVING_ERROR, trans('error_code.'.ErrorCode::DB_SAVING_ERROR));
    }
}

<?php
namespace App\Http\Controllers\Api;

use App\Models\User;
use Response;
use Authorizer;

class UserController extends BaseController
{

    public function getUserInfo()
    {
        $uid = Authorizer::getResourceOwnerId();
        $user = User::find($uid);
        return $this->apiReturn(true, 1, '', $user->getInfo());
    }

}

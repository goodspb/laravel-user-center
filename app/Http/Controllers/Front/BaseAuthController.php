<?php
namespace App\Http\Controllers\Front;

use Auth;

class BaseAuthController extends BaseController
{
    /**
     * @var \App\Models\User|null
     */
    protected $authUser;

    public function __construct()
    {
        $this->authUser = Auth::user();
        $this->assign([
            'auth_user' => $this->authUser
        ]);
    }
}

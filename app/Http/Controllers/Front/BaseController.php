<?php
namespace App\Http\Controllers\Front;

use Auth;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public $authUser;

    public function __construct()
    {
        $this->authUser = Auth::user();
        view()->share('auth_user', $this->authUser);
    }
}

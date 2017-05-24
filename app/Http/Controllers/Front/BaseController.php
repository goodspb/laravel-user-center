<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * 模板前缀
     * @var string
     */
    protected $viewPrefix = 'front.';
}

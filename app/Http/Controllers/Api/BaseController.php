<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Response;

class BaseController extends Controller
{
    protected function apiReturn($status, $code, $message, $data)
    {
        return Response::json(compact('status', 'code', 'message', 'data'));
    }
}

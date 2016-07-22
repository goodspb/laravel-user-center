<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Library\ErrorCode;
use Illuminate\Http\Request;
use Response;

class BaseController extends Controller
{
    protected function apiReturn($status = false, $code = 0, $message = '', $data = '')
    {
        return Response::json(compact('status', 'code', 'message', 'data'));
    }

    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        $error = reset($errors);
        return $this->apiReturn(false, ErrorCode::PARAMS_ERROR,  trans('error_code.'.ErrorCode::PARAMS_ERROR).": ".reset($error));
    }

}

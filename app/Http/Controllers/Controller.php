<?php

namespace App\Http\Controllers;

use Request, Response, Image, Exception;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $allowImageExtension = [
        'jpg', 'jpeg', 'gif', 'png'
    ];

    protected function updateAvatar($uid, $uploadField = 'avatar-file', $filePath = 'upload/avatar')
    {
        $realFilePath = public_path($filePath);
        if (!Request::hasFile($uploadField)) {
            return Response::json(['status' => 'fail', 'msg' => trans('common.upload.empty')]);
        }
        $avatar = Request::file($uploadField);
        list(, $ext) = explode('.', strtolower($avatar->getClientOriginalName()));
        if (!in_array($ext, $this->allowImageExtension)) {
            return Response::json(['status' => 'fail', 'msg' => trans('common.upload.extension_not_allow')]);
        }
        if ($avatar->getSize() > 500000) {
            return Response::json(['status' => 'fail', 'msg' => trans('common.upload.size_too_big')]);
        }
        $md5Uid2 = substr(strtolower($md5Uid = md5($uid)), 0, 2);
        if (!is_dir($avatarPath = $realFilePath . DIRECTORY_SEPARATOR . $md5Uid2)) {
            mkdir($avatarPath, 0777, true);
        }
        try {
            $avatar->move($avatarPath, $md5Uid . '.' . $ext);
            $oldImage = $avatarPath.'/'.$md5Uid.'.'.$ext;
            $newImage = $avatarPath.'/'.$md5Uid.'.png';
            Image::make($oldImage)->fit(150, 150)->save($newImage);
            if ($oldImage != $newImage) {
                unlink($oldImage);
            }
        } catch (Exception $e) {
            return Response::json(['status' => 'fail', 'msg' => $e->getMessage()]);
        }
        return Response::json(['status' => 'success', 'path' => $filePath . '/' . $md5Uid2 . '/' . $md5Uid . '.png']);
    }
}

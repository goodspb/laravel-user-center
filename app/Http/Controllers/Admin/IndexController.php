<?php
namespace App\Http\Controllers\Admin;

class IndexController extends BaseController
{
    public function getIndex()
    {
        $status = [
            'system' => php_uname('s') . '-' . php_uname('r'),
            'php_sapi_name' => php_sapi_name(),
            'php_version' => PHP_VERSION,
            'host' => $_SERVER["HTTP_HOST"],
            'remote_addr' => $_SERVER['REMOTE_ADDR'],
            'server_protocol' => $_SERVER['SERVER_PROTOCOL'],
        ];
        return $this->render('index', compact('status'));
    }

}

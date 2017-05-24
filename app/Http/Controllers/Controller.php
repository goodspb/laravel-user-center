<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $viewPrefix = '';

    /**
     * @param $msg
     * @param null $url
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function errorReturn($msg, $url = null)
    {
        $redirect = redirect();
        if (is_null($url)) {
            $redirect = $redirect->back();
        } else {
            $redirect = $redirect->to($url);
        }
        return $redirect->withErrors(['error' => $msg ]);
    }

    /**
     * @param $msg
     * @param null $url
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function successReturn($msg, $url = null)
    {
        $redirect = redirect();
        if (is_null($url)) {
            $redirect = $redirect->back();
        } else {
            $redirect = $redirect->to($url);
        }
        return $redirect->with('success', $msg);
    }

    /**
     * @param null $view
     * @param array $data
     * @param string $prefix
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function render($view = null, $data = [], $prefix = null)
    {
        $prefix = $prefix ?: $this->viewPrefix;
        return view($prefix.$view, $data);
    }

    /**
     * @param null $to
     * @param int $status
     * @param array $headers
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function redirect($to = null, $status = 302, $headers = [])
    {
        return redirect($to, $status, $headers, true);
    }

    /**
     * @param $key
     * @param null $value
     * @return mixed
     */
    protected function assign($key, $value = null)
    {
        return view()->share($key, $value);
    }

}

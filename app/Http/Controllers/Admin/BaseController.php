<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth, Response, Input, Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Setting;

class BaseController extends Controller
{
    protected $authUser;
    protected $settings;

    public function __construct()
    {
        $this->authUser  = Auth::user();
        $this->settings = Setting::all();
        $this->assign([
            'auth_user' => $this->authUser,
            'settings' => $this->settings,
        ]);
    }

    /**
     * @param $name
     * @param $view
     * @param null $orderKey
     * @param string $orderSort
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    protected function getBaseList($name, $view, $orderKey = null, $orderSort = 'DESC')
    {
        $model = $this->getModel($name);
        $orderKey = is_null($orderKey) ? $model->getKeyName() : $orderKey;
        $lists = $model->orderBy($orderKey, $orderSort)->paginate(10);
        return $this->render($view, ['lists'=> $lists]);
    }

    /**
     * @param $name
     * @param $id
     * @param null $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View | \Illuminate\Database\Eloquent\Model
     */
    protected function getBaseItem($name, $id, $view = null)
    {
        $model = $this->getModel($name);
        $item = $model->find($id);
        if (!$item) {
            throw new NotFoundHttpException;
        }
        return is_null($view) ? $item : $this->render($view, ['item' => $item]);
    }

    /**
     * @param $name
     * @return mixed
     */
    protected function getModel($name)
    {
        $class = 'App\Models\\'.ucfirst($name);
        if (!class_exists($class)) {
            throw new NotFoundHttpException;
        }
        return new $class;
    }

    protected function doDelete($modelName)
    {
        try{
            $item = $this->getBaseItem($modelName, Input::get('id'));
            if ($item->delete()){
                return Response::json(['status'=>1, 'msg'=> trans('common.delete_success')]);
            }
            return Response::json(['status'=> 0, 'msg'=> trans('common.delete_fail')]);
        } catch (Exception $e) {
            return Response::json(['status' => 0, 'msg'=> trans('common.delete_fail')]);
        }
    }

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
    protected function render($view = null, $data = [], $prefix = 'admin.')
    {
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

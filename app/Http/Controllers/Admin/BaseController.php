<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth, Response, Input, Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BaseController extends Controller
{
    public $authUser;

    public function __construct()
    {
        $this->authUser  = Auth::user();
        view()->share('auth_user', $this->authUser);
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
        return view($view, ['lists'=> $lists]);
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
        return is_null($view) ? $item : view($view, ['item' => $item]);
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
}

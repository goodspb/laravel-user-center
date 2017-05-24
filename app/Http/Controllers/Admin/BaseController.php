<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth, Response, Input;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Setting;
use Config;

class BaseController extends Controller
{
    /**
     * @var \App\Models\User|null
     */
    protected $authUser;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @var array|mixed
     */
    protected $menus = [];

    /**
     * 模板前缀
     * @var string
     */
    protected $viewPrefix = 'admin.';

    public function __construct()
    {
        $this->authUser  = Auth::user();
        $this->settings = Setting::all();
        $this->menus = Config::get('menus.admin');
        $this->assign([
            'auth_user' => $this->authUser,
            'settings' => $this->settings,
            'menus' => $this->menus,
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View | \App\Models\Model
     */
    protected function getBaseItem($name, $id, $view = null)
    {
        $model = $this->getModel($name);
        $item = $model->find($id);
        if (!$item) {
            $item = new $model();
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
        $item = $this->getBaseItem($modelName, Input::get('id'));
        if ($item->isNew() && $item->delete()){
            return Response::json(['status'=>1, 'msg'=> trans('common.delete_success')]);
        }
        return Response::json(['status'=> 0, 'msg'=> trans('common.delete_fail')]);
    }
}

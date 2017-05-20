<?php
namespace App\Http\Controllers\Admin;

class IndexController extends BaseController
{
    public function getIndex()
    {
        return $this->render('index');
    }

}

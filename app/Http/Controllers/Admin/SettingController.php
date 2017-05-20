<?php
namespace App\Http\Controllers\Admin;

use Input;
use Setting;

class SettingController extends BaseController
{

    public function getIndex()
    {
        return $this->render('settings');
    }

    public function postEdit()
    {
        $keys = ['app_name', 'cdn_url'];
        $settings = Input::only($keys);
        if ($settings) foreach ($settings as $key => $setting) {
            if ($key == 'cdn_url' && filter_var($setting, FILTER_SANITIZE_URL) === false) {
                $setting = '/';
            }
            Setting::set($key, $setting);
        }
        Setting::save();
        return $this->successReturn('修改成功');
    }

}

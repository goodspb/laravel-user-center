<?php
namespace App\Library;

use Config;
use Illuminate\Routing\UrlGenerator;

class Avatar
{
    /**
     * 生成头像地址
     * @param $avatar
     * @return string
     */
    public static function getAvatar($avatar = '')
    {
        $cdnUrl = rtrim(Config::get('app.cdn_url'), '/');
        if (!$avatar) {
            return $cdnUrl . '/' . ltrim(Config::get('auth.default_avatar'), '/');
        }
        if (app(UrlGenerator::class)->isValidUrl($avatar)) {

            return $avatar;
        }
        return $cdnUrl . '/' . ltrim($avatar, '/');
    }
}

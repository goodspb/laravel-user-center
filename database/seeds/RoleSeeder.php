<?php

use \Illuminate\Database\Seeder;
use \App\Models\Role;

class RoleSeeder extends Seeder
{

    public function run()
    {

        $owner = new Role();
        $owner->name         = 'admin';
        $owner->display_name = '超级管理员'; // optional
        $owner->description  = '最高权限'; // optional
        $owner->save();

        $common = new Role();
        $common->name         = 'editor';
        $common->display_name = '编辑'; // optional
        $common->description  = '后台编辑'; // optional
        $common->save();

    }
}
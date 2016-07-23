<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        $admin = new User();
        $admin->username = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('123456');
        $admin->save();
        $admin->saveProfile();
        $adminRole = Role::where('name', '=', 'admin')->first();
        $admin->attachRole($adminRole);

        //Create a normal user
        $user = new User();
        $user->username = 'test';
        $user->email = 'test@test.com';
        $user->password = bcrypt('123456');
        $user->save();
        $user->saveProfile();
    }

}

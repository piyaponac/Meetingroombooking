<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name','user')->first();
        $role_admin = Role::where('name','admin')->first();
        $role_superadmin = Role::where('name','superadmin')->first();

        $superadmin = New User();
        $superadmin->name = "superadmin";
        $superadmin->username = "superadmin";
        $superadmin->email = "superadmin@mail.com";
        $superadmin->password = bcrypt("123456");
        $superadmin->save();
        $superadmin->roles()->attach($role_superadmin);

        $admin = New User();
        $admin->name = "admin";
        $admin->username = "admin";
        $admin->email = "admin@mail.com";
        $admin->password = bcrypt("123456");
        $admin->save();
        $admin->roles()->attach($role_admin);

        $user = New User();
        $user->name = "user";
        $user->username = "user";
        $user->email = "user@mail.com";
        $user->password = bcrypt("123456");
        $user->save();
        $user->roles()->attach($role_user);
    }
}



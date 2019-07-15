<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**composer dump-autoload
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_superadmin = new Role();
        $role_superadmin->name = "superadmin";
        $role_superadmin->description = "superadmin";
        $role_superadmin->save();

        $role_admin = new Role();
        $role_admin->name = "admin";
        $role_admin->description = "admin";
        $role_admin->save();

        $role_user = new Role();
        $role_user->name = "user";
        $role_user->description = "User";
        $role_user->save();
    }
}

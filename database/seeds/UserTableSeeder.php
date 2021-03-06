<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = Role::where("name", "user")->first();
        $role_manager  = Role::where("name", "admin")->first();
        $employee = new User();
        $employee->name = "Usuario";
        $employee->email = "user@user.com";
        $employee->password = bcrypt("secret");
        $employee->save();
        $employee->roles()->attach($role_employee);
        $manager = new User();
        $manager->name = "Administrador";
        $manager->email = "admin@admin.com";
        $manager->password = bcrypt("secret");
        $manager->save();
        $manager->roles()->attach($role_manager);
    }
}

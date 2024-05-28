<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
            'dashboard',
            'users',
            'users_list',
            'users_permissions',

            'add_user',
            'edit_user',
            'delete_user',

            'view_permission',
            'add_permission',
            'edit_permission',
            'delete_permission',

            'view_user',
            'add_user',
            'edit_user',
            'delete_user',

            'view_car',
            'add_car',
            'edit_car',
            'delete_car',

            'view_driver',
            'add_driver',
            'edit_driver',
            'delete_driver',


        ];
        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create([
                    'name' => $permission
                ]);
            }
        }
    }
}

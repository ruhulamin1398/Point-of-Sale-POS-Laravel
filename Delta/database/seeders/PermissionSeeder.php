<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permissions')->insert([
            [
                'name' => 'Brand Create',
                'page_name' => 'Brand',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Brand Read',
                'page_name' => 'Brand',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Brand Edit',
                'page_name' => 'Brand',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Brand Delete',
                'page_name' => 'Brand',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Brand View',
                'page_name' => 'Brand',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Brand Page',
                'page_name' => 'Brand',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Unit Create',
                'page_name' => 'Unit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Unit Read',
                'page_name' => 'Unit',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Unit Edit',
                'page_name' => 'Unit',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Unit Delete',
                'page_name' => 'Unit',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Unit Page',
                'page_name' => 'Unit',
                'guard_name' => 'web',
            ],
        ]);


        DB::table('roles')->insert([
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'Admin',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Manager',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Analyser',
                'guard_name' => 'web',

            ],
            [
                'name' => 'Staff',
                'guard_name' => 'web',

            ],
        ]);




            
        DB::table('model_has_roles')->insert([
            [
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 1,
            ],
            [
                'role_id' => 2,
                'model_type' => 'App\Models\User',
                'model_id' => 2,
            ],
            [
                'role_id' => 3,
                'model_type' => 'App\Models\User',
                'model_id' => 3,
            ],
        ]);

        DB::table('role_has_permissions')->insert([
            [
                'permission_id' => 1,
                'role_id' => 1,
            ],
            [
                'permission_id' => 2,
                'role_id' => 1,
            ],
            [
                'permission_id' => 3,
                'role_id' => 1,
            ],
            [
                'permission_id' => 4,
                'role_id' => 1,
            ],
            [
                'permission_id' => 5,
                'role_id' => 1,
            ],
            [
                'permission_id' => 6,
                'role_id' => 1,
            ],
            [
                'permission_id' => 7,
                'role_id' => 1,
            ],
            [
                'permission_id' => 8,
                'role_id' => 1,
            ],
            [
                'permission_id' => 9,
                'role_id' => 1,
            ],
            [
                'permission_id' => 1,
                'role_id' => 2,
            ],
            [
                'permission_id' => 2,
                'role_id' => 2,
            ],
            [
                'permission_id' => 3,
                'role_id' => 2,
            ],
            [
                'permission_id' => 4,
                'role_id' => 2,
            ],
            [
                'permission_id' => 5,
                'role_id' => 2,
            ],
            [
                'permission_id' => 6,
                'role_id' => 2,
            ],
            [
                'permission_id' => 7,
                'role_id' => 2,
            ],
            [
                'permission_id' => 8,
                'role_id' => 2,
            ],
            [
                'permission_id' => 9,
                'role_id' => 2,
            ],
            [
                'permission_id' => 1,
                'role_id' => 3,
            ],
            [
                'permission_id' => 4,
                'role_id' => 3,
            ],
            [
                'permission_id' => 5,
                'role_id' => 3,
            ],
            [
                'permission_id' => 6,
                'role_id' => 3,
            ],
            [
                'permission_id' => 7,
                'role_id' => 3,
            ],
            [
                'permission_id' => 8,
                'role_id' => 3,
            ],
            [
                'permission_id' => 9,
                'role_id' => 3,
            ],
            [
                'permission_id' => 3,
                'role_id' => 4,
            ],
            [
                'permission_id' => 4,
                'role_id' => 4,
            ],
            [
                'permission_id' => 5,
                'role_id' => 4,
            ],
            [
                'permission_id' => 6,
                'role_id' => 4,
            ],
            [
                'permission_id' => 7,
                'role_id' => 4,
            ],
            [
                'permission_id' => 8,
                'role_id' => 4,
            ],
            [
                'permission_id' => 9,
                'role_id' => 4,
            ],
            
            [
                'permission_id' => 1,
                'role_id' => 5,
            ],
            [
                'permission_id' => 2,
                'role_id' => 5,
            ],
            [
                'permission_id' => 3,
                'role_id' => 5,
            ],
            [
                'permission_id' => 5,
                'role_id' => 5,
            ],
            [
                'permission_id' => 6,
                'role_id' => 5,
            ],
        ]);

    }
}

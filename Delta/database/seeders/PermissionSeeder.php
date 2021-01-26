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
                'name' => 'create',
                'route_name' => 'products',
                'guard_name' => 'web',
            ],
            [
                'name' => 'read',
                'route_name' => 'products',
                'guard_name' => 'web',

            ],
            [
                'name' => 'edit',
                'route_name' => 'products',
                'guard_name' => 'web',

            ],
            [
                'name' => 'delete',
                'route_name' => 'products',
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
                'role_id' => 2,
            ],
            [
                'permission_id' => 3,
                'role_id' => 3,
            ],
        ]);

    }
}

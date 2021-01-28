<?php

namespace Database\Seeders;

use App\Http\Controllers\SettingController;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call(PermissionSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(PosSettingSeeder::class);
    }
}

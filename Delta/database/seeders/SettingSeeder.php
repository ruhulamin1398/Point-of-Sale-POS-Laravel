<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'table_name' => 'brands',
                'model' => 'App\Models\brand.php',
                'setting' => '"[{\"componentDetails\":{\"title\":\"Brand List\",\"editTitle\":\"Edit Brand\"},\"routes\":{\"create\":{\"name\":\"brands.create\",\"link\":\"brands\"},\"update\":{\"name\":\"brands.update\",\"link\":\"brands\"},\"delete\":{\"name\":\"brands.destroy\",\"link\":\"brands\"}},\"fieldList\":[{\"position\":\"1\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"require\":\"1\",\"name\":\"name\",\"input_type\":\"text\",\"database_name\":\"name\",\"title\":\"Name\"},{\"position\":\"2\",\"create\":\"1\",\"read\":\"1\",\"update\":\"1\",\"require\":\"0\",\"name\":\"description\",\"input_type\":\"text\",\"database_name\":\"description\",\"title\":\"Description\"}]}]"',
            ],
            [
                'table_name' => 'customers',
                'model' => 'App\Models\customer.php',
                'setting' => '"[{\"componentDetails\":{\"title\":\"Customers List\",\"editTitle\":\"Edit Customers\"},\"routes\":{\"create\":{\"name\":\"customers.create\",\"link\":\"customers\"},\"update\":{\"name\":\"customers.update\",\"link\":\"customers\"},\"delete\":{\"name\":\"customers.destroy\",\"link\":\"customers\"}},\"fieldList\":[{\"position\":\"1\",\"create\":\"1\",\"read\":\"1\",\"update\":\"0\",\"require\":\"1\",\"name\":\"phone\",\"input_type\":\"number\",\"database_name\":\"phone\",\"title\":\"Phone\"},{\"position\":\"2\",\"create\":\"2\",\"read\":\"1\",\"update\":\"2\",\"require\":\"0\",\"name\":\"due\",\"input_type\":\"number\",\"database_name\":\"due\",\"title\":\"Due\"},{\"position\":\"3\",\"create\":\"1\",\"read\":\"1\",\"update\":\"0\",\"require\":\"1\",\"name\":\"name\",\"input_type\":\"text\",\"database_name\":\"name\",\"title\":\"Name\"},{\"position\":\"4\",\"create\":\"1\",\"read\":\"1\",\"update\":\"0\",\"require\":\"0\",\"name\":\"address\",\"input_type\":\"text\",\"database_name\":\"address\",\"title\":\"Address\"},{\"position\":\"5\",\"create\":\"1\",\"read\":\"1\",\"update\":\"0\",\"require\":\"0\",\"name\":\"company\",\"input_type\":\"text\",\"database_name\":\"company\",\"title\":\"Company\"}]}]"',
            ],
        ]);

    }
}

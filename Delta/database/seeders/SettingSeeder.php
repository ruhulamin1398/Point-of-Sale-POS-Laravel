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
            [
                'table_name' => 'designations',
                'model' => 'App\Models\designation.php',
                'setting' => '"[{\n            \"componentDetails\":{\n                \"title\":\"Designation List\",\n                \"editTitle\":\"Edit Designation\"\n            },\n            \"routes\":{\n                \"create\":{\n                    \"name\":\"designations.create\",\n                    \"link\":\"designations\"\n                },\n                \"update\":{\n                    \"name\":\"designations.update\",\n                    \"link\":\"designations\"\n                },\n                \"delete\":{\n                    \"name\":\"designations.destroy\",\n                    \"link\":\"designations\"\n                }\n            },\n            \"fieldList\":[{\n                \n                    \"position\":11,\n        \n                    \"create\":\"1\",\n                    \"read\":\"1\",\n                    \"update\":\"1\",\n                    \"require\":\"0\",\n        \n                    \"name\":\"role\",\n                    \"input_type\" : \"text\",\n                    \"database_name\":\"role\",  \n                    \"title\":\"Name\"\n                }\n            ]\n        }]"',
            ],
            [
                'table_name' => 'drop_products',
                'model' => 'App\Models\dropProduct.php',
                'setting' => '"[{\n            \"componentDetails\":{\n                \"title\":\"Designation List\",\n                \"editTitle\":\"Edit Designation\"\n            },\n            \"routes\":{\n                \"create\":{\n                    \"name\":\"drop_products.create\",\n                    \"link\":\"drop_products\"\n                },\n                \"update\":{\n                    \"name\":\"drop_products.update\",\n                    \"link\":\"drop_products\"\n                },\n                \"delete\":{\n                    \"name\":\"drop_products.destroy\",\n                    \"link\":\"drop_products\"\n                }\n            },\n            \"fieldList\":[{\n                \n                \"position\":11,\n    \n                \"create\":\"3\",\n                \"read\":\"1\",\n                \"update\":\"3\",\n                \"require\":\"0\",\n    \n                \"name\":\"user\",\n                \"input_type\" : \"text\",\n                \"database_name\":\"user_id\",  \n                \"title\":\"Employee Name\"\n             },{\n                \n                \"position\":11,\n    \n                \"create\":\"2\",\n                \"read\":\"1\",\n                \"update\":\"2\",\n                \"require\":\"1\",\n    \n                \"name\":\"product\",\n                \"input_type\" : \"dropDown\",\n                \"database_name\":\"product_id\",  \n                \"title\":\"Product\",\n                \"data\" : \"products\"\n            },{\n                \n                \"position\":11,\n    \n                \"create\":\"2\",\n                \"read\":\"1\",\n                \"update\":\"2\",\n                \"require\":\"1\",\n    \n                \"name\":\"quantity\",\n                \"input_type\" : \"text\",\n                \"database_name\":\"quantity\",  \n                \"title\":\"Quantity\"\n            },{\n                \n                \"position\":11,\n    \n                \"create\":\"1\",\n                \"read\":\"1\",\n                \"update\":\"1\",\n                \"require\":\"0\",\n    \n                \"name\":\"comment\",\n                \"input_type\" : \"text\",\n                \"database_name\":\"comment\",  \n                \"title\":\"Comment\"\n            }\n            ]\n        }]"',
            ],
        ]);

    }
}

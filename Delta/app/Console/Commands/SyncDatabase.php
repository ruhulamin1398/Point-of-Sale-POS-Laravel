<?php

namespace App\Console\Commands;

use App\Models\onlineSync;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Http;

class SyncDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:sync';
    protected $datas;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {



        
        // $this->datas = onlineSync::all();
        // foreach ($this->datas as $data) {
        //     if( !($data->model == 'UserRole' || $data->model == 'RolePermission') ){
        //         $data->data = $data->model::withTrashed()->find($data->reference_id);
        //     }
        //     $response = Http::withBasicAuth('superadmin@abasas.tech', '1234')->retry(5, 200)->post('http://127.0.0.1:7000/api/sync-database', [
        //         'data' => $data
        //     ]);
        //     if ($response->status() == 200) {
        //         $data->delete();
        //         $this->info('The command was successful!');
        //     }
        //     else{
        //         $this->error('Something went wrong!');
        //     }
        // }
        // $this->info('The command was Finished!');



        $connected = @fsockopen("www.example.com", 80);
        if ($connected) {
            $this->datas = onlineSync::all();
            foreach ($this->datas as $data) {
                if( !($data->model == 'UserRole' || $data->model == 'RolePermission') ){
                    $data->data = $data->model::withTrashed()->find($data->reference_id);
                }
                $response = Http::withBasicAuth('superadmin@abasas.tech', '1234')->retry(5, 200)->post('https://demos.abasas.tech/saas/Delta/public/api/sync-database', [
                    'data' => $data
                ]);
                if ($response->status() == 200) {
                    $data->delete();
                    $this->info('The command was successful!');
                }
                else{
                    $this->error('Something went wrong!');
                }
            }
            fclose($connected);
        } else {
            $this->error('Bad internet connection');
        }

        $this->info('The command Finished!');

    }
}

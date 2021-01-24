<?php

namespace App\Console\Commands;

use App\Models\category;
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
    protected $signature = 'sync:database';
    protected $data;

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

             $this->data = onlineSync::first();
             $this->data->data = category::find($this->data->reference_id);

        // while( true ){
        //     $this->data = onlineSync::first();
            
        //     if(!is_null($this->data)){
            $response = Http::withBasicAuth('admin@abasas.tech', '1234')->post('https://demos.abasas.tech/saas/Delta/public/api/sync-database', [
                'data' => $this->data
            ]);
        //     }      
        //     else{
        //         break;
        //     }
        // }
    }
}

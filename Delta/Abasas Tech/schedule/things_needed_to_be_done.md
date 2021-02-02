
- bar code print page
- cursor grab and grabing 
- notification on update and delete . 


- purchase page cost calculation on same product diffrent time (average)
- cash management system 
- product count on sell analysis and purchase analysis


---------------------------------------

- order and puchase -> create page(বাকি রইছে)   translation
    





<!-- Sync test -->
        $this->datas = onlineSync::all();
            foreach ($this->datas as $data) {
                $data->data = $data->model::withTrashed()->find($data->reference_id);
                $response = Http::withBasicAuth('admin@abasas.tech', '1234')->retry(10, 500)->post('http://127.0.0.1:7000/api/sync-database', [
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
            $this->info('The command was successful!');





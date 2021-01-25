- number validation , number must be greatr than or equal to zero.
- in product barcode print button.
- drop product auth
- bar code print page
- every modal must have withTrashed <!-- primarly done -->
- number validation for positive
- in setting every required items update must be 2.
- update validation needs to be updated.
- cursor grab and grabing 
- Employee delete thinking needed . 
- notification on update and delete . 
- non createable and non updateable page createLabe and updateLabel hide .

- Tax in only products not in purchase 

- order page input types number and parse float 
- purchase page cost calculation on same product diffrent time (average)
- supplier ,custommer , user , employee delete -> permanent users .
- purchase page quantity in kg or piece 
- discount management page 
- purchase page product details tax + warrenty  
- customer number check in submit order page
- serial in page of products
- notifications can be de by dataTable
- cash management system 
- product count on sell analysis and purchase analysis
- auth in return product
- auth in customer due
- auth in supplier due


---------------------------------------

- order and puchase -> create page(বাকি রইছে)   translation

-  page  not showing {
    - categories
    - product_type
    - units
    - customer-rating
    - sell_type
}

- sidebar {

    - product-> (product Analaysis)
    - পণ্য বিক্রয় 
    - পণ্য ক্রয়
    
}

translation ->{
    - customer controller 140 number line cannt be tranlstede. 
}





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
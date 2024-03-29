<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DataTable extends Component
{
    public $dataArray;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dataArray)
    {
        $this->dataArray= $dataArray;
       
 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        
        $roles = Role::all();
        $permissions = Permission::where('page_name',$this->dataArray['page_name'])->get();
        return view('components.data-table',compact('roles','permissions'));
    }
}

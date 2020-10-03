<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $items,$fieldList,$routes,$componentDetails;
    /**
     * Create a new component instance.
     *
     * @return void
     * @param array $fieldList
     */
    public function __construct($items,$fieldList,$routes,$componentDetails)
    {
        $this->items= $items;
        $this->fieldList= $fieldList;
        $this->routes= $routes;
        $this->componentDetails= $componentDetails;
 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.data-table');
    }
}

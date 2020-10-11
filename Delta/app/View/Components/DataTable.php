<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $items,$routes,$componentDetails,$settings;
    /**
     * Create a new component instance.
     *
     * @return void
     * @param array $fieldList
     */
    public function __construct($items,$routes,$componentDetails,$settings)
    {
        $this->items= $items;
        $this->routes= $routes;
        $this->componentDetails= $componentDetails;
        $this->settings= $settings;
 
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

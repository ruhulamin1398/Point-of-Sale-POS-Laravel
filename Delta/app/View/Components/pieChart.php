<?php

namespace App\View\Components;

use Illuminate\View\Component;

class pieChart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $dataArray;
    public $id;
    public function __construct($dataArray,$id)
    {
        $this->dataArray= $dataArray;
        $this->id= $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.pie-chart');
    }
}

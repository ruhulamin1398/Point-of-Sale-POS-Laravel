<?php

namespace App\View\Components;

use Illuminate\View\Component;

class lineChart extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $dataArray;
    public function __construct($dataArray,$id)
    {
        $this->id= $id;
        $this->dataArray= $dataArray;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.line-chart');
    }
}

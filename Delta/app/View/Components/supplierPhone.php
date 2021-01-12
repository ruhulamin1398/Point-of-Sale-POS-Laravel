<?php

namespace App\View\Components;

use App\Models\supplier;
use Illuminate\View\Component;

class supplierPhone extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $suppliers = supplier::all();
        return view('components.supplier-phone',compact('suppliers'));
    }
}

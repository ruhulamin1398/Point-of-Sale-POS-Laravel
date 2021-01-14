<?php

namespace App\View\Components;

use App\Models\customer;
use Illuminate\View\Component;

class CustomerPhone extends Component
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
        $customers = customer::all();
        return view('components.customer-phone',compact('customers'));
    }
}

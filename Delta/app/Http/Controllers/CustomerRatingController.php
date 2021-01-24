<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRatingRequest;
use App\Models\customerRating;
use App\Models\onlineSync;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;

class CustomerRatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRatingRequest $request)
    { 
        $customerRating = new customerRating;
        $customerRating->star_count = $request->star_count;
        $customerRating->name = $request->name;
        $customerRating->description = $request->description;
        $customerRating->save();

        // $online_sync = new onlineSync;
        // $online_sync->model = 'App\Models\customer';
        // $online_sync->action_type = 'create';
        // $online_sync->reference_id = $customer->id;
        // $online_sync->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customerRating  $customerRating
     * @return \Illuminate\Http\Response
     */
    public function show(customerRating $customerRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customerRating  $customerRating
     * @return \Illuminate\Http\Response
     */
    public function edit(customerRating $customerRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customerRating  $customerRating
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRatingRequest $request, customerRating $customerRating)
    {
        $customerRating->star_count = $request->star_count;
        $customerRating->name = $request->name;
        $customerRating->description = $request->description;
        $customerRating->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customerRating  $customerRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(customerRating $customerRating)
    {
        //
    }
}

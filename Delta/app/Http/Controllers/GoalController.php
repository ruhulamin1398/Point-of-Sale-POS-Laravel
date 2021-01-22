<?php

namespace App\Http\Controllers;

use App\Models\goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goal = goal::find(1);
        return view('goal.index',compact('goal'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(goal $goal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(goal $goal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, goal $goal)
    {
        $goal->daily = $request->daily;
        $goal->weekly = $request->weekly;
        $goal->monthly = $request->monthly;
        $goal->yearly = $request->yearly;
        $goal->save();
        return redirect()->back()->withSuccess(['Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy(goal $goal)
    {
        //
    }
}

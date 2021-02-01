<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if(! auth()->user()->hasPermissionTo('User Page')){
            return abort(401);
        }
        $roles = Role::all();
        $employees = employee::whereNull('user_id')->get();
        $users = User::all();
        return view('user.index',compact('users','employees','roles'));
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
    public function store(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email  = $request->email ;
        $user->password =  Hash::make($request->password);
        $user->name = $request->name;
        $user->save();
        $employee = employee::find($request->employee_id);
        $employee->user_id = $user->id;
        $employee->save();
        
        $role = Role::find($request->role_id);
        $user->assignRole($role);
        
        $this->onlineSync('userTable','create',$user->id);
        $this->onlineSync('employee','update',$employee->id);
        return redirect()->back()->withSuccess(["User Created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if( is_null($request->password) || strlen($request->password)<6){
            return Redirect::back()->withErrors(["Enter a valid Password" ]);
        }
        $user->password =  Hash::make($request->password);
        $user->save();
        $this->onlineSync('userTable','update',$user->id);
        return redirect()->back()->withSuccess(["Password Updated"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User  $user)
    {
        $employee = employee::find($user->employee->id);
        $user->delete();
        $employee->user_id = Null ;
        $employee->save();
        
        $this->onlineSync('userTable','delete',$user->id);
        $this->onlineSync('employee','update',$employee->id);
        return redirect()->back()->withErrors(["User Deleted"]);
        
    }
}

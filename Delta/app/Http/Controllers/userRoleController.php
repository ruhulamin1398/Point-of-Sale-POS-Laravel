<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class userRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $roles = Role::all();
        $user_with_roles = User::with('roles')->get();
        return view('permissions.index',compact('user_with_roles','roles'));
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
        if($request->user_id == 1){
            return redirect()->back()->withErrors(['Cant Change Super Admin']);
        }
        $role = Role::find($request->role_id);
        $user = User::find($request->user_id);

        $prev_role_names = $user->getRoleNames();
        if(count($prev_role_names)>0){
            $prev_role = Role::where('name',$user->getRoleNames()[0])->first();
            $user->removeRole($prev_role);
        }

        $user->assignRole($role);
        return redirect()->back()->withSuccess(['Role given Successfully']);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        if($id == 1){
            return redirect()->back()->withErrors(['Cant Delete Superadmin']);
        }else{
            $user = User::find($id);
            $userrole =   $user->getRoleNames();
         $role = Role::where('name',$userrole)->first();
         $user->removeRole($role);
         return redirect()->back()->withErrors(['Role Removed']);
        }
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rolepermissionstore(Request $request)
    {
        return $request;
    }
}

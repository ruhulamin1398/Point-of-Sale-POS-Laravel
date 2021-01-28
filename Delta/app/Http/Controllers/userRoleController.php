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
        $roles = Role::all();
        $permissions = Permission::where('page_name',$request->page_name)->get();
        // return $request;
        // Create Permission
        $create_permission = $permissions->where('name',$request->page_name.' Create')->first();
        if(!is_null($create_permission)){
            
            if($request->create1 == 'on'){
                $roles[1]->givePermissionTo($create_permission->name);
            }
            else{
                $roles[1]->revokePermissionTo($create_permission->name);
            }
            if($request->create2 == 'on'){
                $roles[2]->givePermissionTo($create_permission->name);
            }
            else{
                $roles[2]->revokePermissionTo($create_permission->name);
            }
            if($request->create3 == 'on'){
                $roles[3]->givePermissionTo($create_permission->name);
            }
            else{
                $roles[3]->revokePermissionTo($create_permission->name);
            }
            if($request->create4 == 'on'){
                $roles[4]->givePermissionTo($create_permission->name);
            }
            else{
                $roles[4]->revokePermissionTo($create_permission->name);
            }



        }

        // Read Permission
        $read_permission = $permissions->where('name',$request->page_name.' Read')->first();
        if(!is_null($read_permission)){
            
            if($request->read1 == 'on'){
                $roles[1]->givePermissionTo($read_permission->name);
            }
            else{
                $roles[1]->revokePermissionTo($read_permission->name);
            }
            if($request->read2 == 'on'){
                $roles[2]->givePermissionTo($read_permission->name);
            }
            else{
                $roles[2]->revokePermissionTo($read_permission->name);
            }
            if($request->read3 == 'on'){
                $roles[3]->givePermissionTo($read_permission->name);
            }
            else{
                $roles[3]->revokePermissionTo($read_permission->name);
            }
            if($request->read4 == 'on'){
                $roles[4]->givePermissionTo($read_permission->name);
            }
            else{
                $roles[4]->revokePermissionTo($read_permission->name);
            }
        }

        // Edit Permission
        $edit_permission = $permissions->where('name',$request->page_name.' Edit')->first();
        if(!is_null($edit_permission)){
            
            if($request->edit1 == 'on'){
                $roles[1]->givePermissionTo($edit_permission->name);
            }
            else{
                $roles[1]->revokePermissionTo($edit_permission->name);
            }
            if($request->edit2 == 'on'){
                $roles[2]->givePermissionTo($edit_permission->name);
            }
            else{
                $roles[2]->revokePermissionTo($edit_permission->name);
            }
            if($request->edit3 == 'on'){
                $roles[3]->givePermissionTo($edit_permission->name);
            }
            else{
                $roles[3]->revokePermissionTo($edit_permission->name);
            }
            if($request->edit4 == 'on'){
                $roles[4]->givePermissionTo($edit_permission->name);
            }
            else{
                $roles[4]->revokePermissionTo($edit_permission->name);
            }
        }

        // Delete Permission
        $delete_permission = $permissions->where('name',$request->page_name.' Delete')->first();
        if(!is_null($delete_permission)){
            
            if($request->delete1 == 'on'){
                $roles[1]->givePermissionTo($delete_permission->name);
            }
            else{
                $roles[1]->revokePermissionTo($delete_permission->name);
            }
            if($request->delete2 == 'on'){
                $roles[2]->givePermissionTo($delete_permission->name);
            }
            else{
                $roles[2]->revokePermissionTo($delete_permission->name);
            }
            if($request->delete3 == 'on'){
                $roles[3]->givePermissionTo($delete_permission->name);
            }
            else{
                $roles[3]->revokePermissionTo($delete_permission->name);
            }
            if($request->delete4 == 'on'){
                $roles[4]->givePermissionTo($delete_permission->name);
            }
            else{
                $roles[4]->revokePermissionTo($delete_permission->name);
            }
        }

        // View Permission
        $view_permission = $permissions->where('name',$request->page_name.' View')->first();
        if(!is_null($view_permission)){
            
            if($request->view1 == 'on'){
                $roles[1]->givePermissionTo($view_permission->name);
            }
            else{
                $roles[1]->revokePermissionTo($view_permission->name);
            }
            if($request->view2 == 'on'){
                $roles[2]->givePermissionTo($view_permission->name);
            }
            else{
                $roles[2]->revokePermissionTo($view_permission->name);
            }
            if($request->view3 == 'on'){
                $roles[3]->givePermissionTo($view_permission->name);
            }
            else{
                $roles[3]->revokePermissionTo($view_permission->name);
            }
            if($request->view4 == 'on'){
                $roles[4]->givePermissionTo($view_permission->name);
            }
            else{
                $roles[4]->revokePermissionTo($view_permission->name);
            }
        }
        // Page Permission
        $page_permission = $permissions->where('name',$request->page_name.' Page')->first();
        if(!is_null($page_permission)){
            
            if($request->page1 == 'on'){
                $roles[1]->givePermissionTo($page_permission->name);
            }
            else{
                $roles[1]->revokePermissionTo($page_permission->name);
            }
            if($request->page2 == 'on'){
                $roles[2]->givePermissionTo($page_permission->name);
            }
            else{
                $roles[2]->revokePermissionTo($page_permission->name);
            }
            if($request->page3 == 'on'){
                $roles[3]->givePermissionTo($page_permission->name);
            }
            else{
                $roles[3]->revokePermissionTo($page_permission->name);
            }
            if($request->page4 == 'on'){
                $roles[4]->givePermissionTo($page_permission->name);
            }
            else{
                $roles[4]->revokePermissionTo($page_permission->name);
            }
        }
        // price Permission
        $price_permission = $permissions->where('name',$request->page_name.' Price')->first();
        if(!is_null($page_permission)){
            
            if($request->price1 == 'on'){
                $roles[1]->givePermissionTo($price_permission->name);
            }
            else{
                $roles[1]->revokePermissionTo($price_permission->name);
            }
            if($request->price2 == 'on'){
                $roles[2]->givePermissionTo($price_permission->name);
            }
            else{
                $roles[2]->revokePermissionTo($price_permission->name);
            }
            if($request->price3 == 'on'){
                $roles[3]->givePermissionTo($price_permission->name);
            }
            else{
                $roles[3]->revokePermissionTo($price_permission->name);
            }
            if($request->price4 == 'on'){
                $roles[4]->givePermissionTo($price_permission->name);
            }
            else{
                $roles[4]->revokePermissionTo($price_permission->name);
            }
        }
        // cost Permission
        $cost_permission = $permissions->where('name',$request->page_name.' Cost')->first();
        if(!is_null($page_permission)){
            
            if($request->cost1 == 'on'){
                $roles[1]->givePermissionTo($cost_permission->name);
            }
            else{
                $roles[1]->revokePermissionTo($cost_permission->name);
            }
            if($request->cost2 == 'on'){
                $roles[2]->givePermissionTo($cost_permission->name);
            }
            else{
                $roles[2]->revokePermissionTo($cost_permission->name);
            }
            if($request->cost3 == 'on'){
                $roles[3]->givePermissionTo($cost_permission->name);
            }
            else{
                $roles[3]->revokePermissionTo($cost_permission->name);
            }
            if($request->cost4 == 'on'){
                $roles[4]->givePermissionTo($cost_permission->name);
            }
            else{
                $roles[4]->revokePermissionTo($cost_permission->name);
            }
        }
        
        // graph Permission
        $grap_permission = $permissions->where('name',$request->page_name.' Graph')->first();
        if(!is_null($page_permission)){
            
            if($request->graph1 == 'on'){
                $roles[1]->givePermissionTo($grap_permission->name);
            }
            else{
                $roles[1]->revokePermissionTo($grap_permission->name);
            }
            if($request->graph2 == 'on'){
                $roles[2]->givePermissionTo($grap_permission->name);
            }
            else{
                $roles[2]->revokePermissionTo($grap_permission->name);
            }
            if($request->graph3 == 'on'){
                $roles[3]->givePermissionTo($grap_permission->name);
            }
            else{
                $roles[3]->revokePermissionTo($grap_permission->name);
            }
            if($request->graph4 == 'on'){
                $roles[4]->givePermissionTo($grap_permission->name);
            }
            else{
                $roles[4]->revokePermissionTo($grap_permission->name);
            }
        }
        
        // Print Permission
        $print_permission = $permissions->where('name',$request->page_name.' Print')->first();
        if(!is_null($page_permission)){
            
            if($request->print1 == 'on'){
                $roles[1]->givePermissionTo($print_permission->name);
            }
            else{
                $roles[1]->revokePermissionTo($print_permission->name);
            }
            if($request->print2 == 'on'){
                $roles[2]->givePermissionTo($print_permission->name);
            }
            else{
                $roles[2]->revokePermissionTo($print_permission->name);
            }
            if($request->print3 == 'on'){
                $roles[3]->givePermissionTo($print_permission->name);
            }
            else{
                $roles[3]->revokePermissionTo($print_permission->name);
            }
            if($request->print4 == 'on'){
                $roles[4]->givePermissionTo($print_permission->name);
            }
            else{
                $roles[4]->revokePermissionTo($print_permission->name);
            }
        }



        return redirect()->back()->withSuccess(['Permissions Saved']);
        // $role->givePermissionTo($permission);
        // $role->revokePermissionTo($permission);
    }
}

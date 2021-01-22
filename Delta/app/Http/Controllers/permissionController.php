<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        //  $role= Role::find(1);
        // // $permission = Permission::find(1);
        //  $user = User::find(Auth::user()->id);
        // // $role->givePermissionTo($permission);
        // $user->givePermissionTo($permission);
        // // return $user->permissions;
        // $permission = Permission::create(['name' => 'read']);
        // $users = User::all();
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


        $role = Role::find($request->role_id);
        $user = User::find($request->user_id);
        
            
        $userallrole =  count($user->getRoleNames()) ;
        
       if($userallrole == 0){

        $user->assignRole($role);
        return redirect()->back()->withSuccess(['Role given Successfully']);
       }else{

        return redirect()->back()->withErrors(['User already Have Role']);
       }


           


        // $user->givePermissionTo($permission);


     
    //    $userallpermissions =   $role->getAllPermissions();
    //    $countedPermission = count($userallpermissions);

        
    //    if($countedPermission == 0 ){

    //      $role->givePermissionTo($permission);
    //      return redirect()->back()->withSuccess(['Permission given Successfully']);
        
    //    }else{



    //     foreach($userallpermissions as $userpermission){
    //         $permissionId =  $userpermission->id;
    //      }
     
    //        if($permissionId != $request->permission_id){
   
    //            $role->givePermissionTo($permission);
    //            
   
    //        }else{
   
    //           return redirect()->back()->withErrors(['Permission is already exist']);
    //        }
   
    //    }



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


            // $user->revokePermissionTo($userallpermissions);
         return redirect()->back()->withErrors(['Role Removed']);

        }


        
      


    }




    public function rolepermissionstore(Request $request)
        {
            $role = Role::find($request->role_id);
             $permission = Permission::find($request->permission_id);
             
            
            $role->givePermissionTo($permission);
            return redirect()->back()->withSuccess(['Permission given Successfully']);
             

           
        }

        public function removePermission(Request $request)
        {
    
            $role = Role::find($request->role_id);
            $permission = Permission::find($request->permission_id);


            $role->revokePermissionTo($permission);
            return redirect()->back()->withErrors(['Permission Removed']);


           
        }
    

}

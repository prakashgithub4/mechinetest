<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth','subadmin']);
        //$this->middleware('auth');
    }
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.roles',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
          ]);
          $newRole = new Role();
          $newRole->name = $request->name;
          $newRole->status = $request->status;
          $newRole->save();
          return redirect('roles/')->with('success','Role created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $role = Role::find(decrypt($id));
        return view('admin.role.edit',compact('role'));

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
        $updateRole = Role::find(decrypt($id));
        $updateRole->name = $request->name;
        $updateRole->status = $request->status;
        $updateRole->save();
        return redirect('roles/')->with('success','Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $role_id = decrypt($id);
        $role_delete = Role::find($role_id);
        $role_delete->delete();
        return redirect('roles/')->with('success','Role Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware(['auth','subadmin']);
    }
    public function index()
    {
        $users = User::whereNotNull('role_id')->get();
        $currentUser = \Auth::user()->role_id;
        $user_list_display_by_role = \App\Models\Role::where('id',$currentUser)->whereIn('name',['Admin','Sub Admin'])->first();
        $user_import_for_admin = \App\Models\Role::where('id',$currentUser)->whereIn('name',['Admin'])->first();
        return view('admin.user.users',compact('users','user_list_display_by_role','user_import_for_admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::where('status','1')->get();
        return view('admin.user.add',compact('roles'));
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
            'email' => 'required|email|unique:users,email',
            'phone'=>'required|unique:users,phone|max:10',
            'photo'=>'mimes:png,jpg,jpeg|max:2000',
            'role'=>'required',
            'password'=>'required'
          ]);

          if($request->has('photo')){
            $fileName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $fileName);
          }

          $user['name'] = $request->name;
          $user['email'] = $request->email;
          $user['password'] = $request->password;
          $user['phone'] = $request->phone;
          $user['role_id'] = $request->role;
          $user['profile_image'] = $fileName;
          User::create($user);
          return redirect('user')->with('success','User has been created successfully');

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
        $id = decrypt($id);
        $user = User::find($id);
        $roles = Role::where('status','1')->get();
        return view('admin.user.edit',compact('user','roles'));
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
        $validatedData = $request->validate([
            'phone'=>'required|max:10',
            'photo'=>'mimes:png,jpg,jpeg|max:2000',
          ]);

        $id = decrypt($id);
        $user = User::find($id);
        $user->name = $request->name;
       // $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->has('password')){
            $user->password = $request->password;
        }
        if($request->has('photo')){
            $fileName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $fileName);
            $user->profile_image = $fileName;
        }
        $user->status = $request->status;
        $user->save();
        return redirect('user')->with('success','User has been Successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = decrypt($id);
        $user = User::find($userId);
        $user->delete();
        return redirect('user')->with('success','User deleted successfully');
    }
    public function user_import(Request $request){
        Excel::import(new UsersImport, request()->file('file'));
        return redirect()->back()->with('success','Data Imported Successfully');
    }
}

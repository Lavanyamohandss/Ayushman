<?php

namespace App\Http\Controllers;
use App\Models\Mst_User;
use App\Models\Mst_Master_Value;
use App\Models\Mst_Branch;
use App\Models\Mst_Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class MstUserController extends Controller
{
    public function index()
    {
        $pageTitle = "Users";
        $userTypes = Mst_Master_Value::where('master_id',4)->pluck('master_value','id');
        $staff = Mst_Staff::pluck('staff_name','staff_id');
        $users = Mst_User::latest()->get();
        return view('user.index', compact('pageTitle','users','userTypes','staff'));
    }

    public function create()
    {
        $pageTitle = "Create User";
        $userTypes = Mst_Master_Value::where('master_id',4)->pluck('master_value','id');
        $staffs = Mst_Staff::pluck('staff_name','staff_id');

        return view('user.create', compact('pageTitle','userTypes','staffs'));
    }

    public function store(Request $request)
   { 
    // Validate the input data

    $request->validate([
        'username' => 'required',
        'password' => 'required',
        'confirm_password' => 'required|same:password',
        'user_email' => 'required|email',
        'user_type_id' => 'required',
        'is_active' =>'required',
    ]);

    $is_active = $request->input('is_active') ? 1 : 0;

    $user = new  Mst_User();
    $user->username = $request->input('username');
    $user->password = Hash::make($request->input('password'));
    $user->user_email = $request->input('user_email');
    $user->user_type_id = $request->input('user_type_id');
    $user->staff_id = $request->input('staff_id');
    $user->is_active = $is_active;
    $user->last_login_time = now();
    $user->created_by = 1;
    $user->last_updated_by = 1;
    $user->save();

  

    return redirect()->route('user.index')->with('success', 'User added successfully');
}


public function edit($id)
{ 
    $pageTitle = "Edit User";
    $user = Mst_User::find($id);
    $userTypes = Mst_Master_Value::where('master_id',4)->pluck('master_value','id');
    $staff = Mst_Staff::pluck('staff_name','staff_id');

    return view('user.edit', compact('pageTitle','user','userTypes','staff'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'username' => 'required',
        // 'password' => 'required',
        // 'confirm_password' => 'required|same:password',
        'user_email' => 'required|email',
        'user_type_id' => 'required',
        'staff_id' => 'required',
      
    ]);
    $is_active = $request->input('is_active') ? 1 : 0;

    $user =  Mst_User::findOrFail($id);
    $user->username = $request->input('username');
    $user->password = Hash::make($request->input('password'));
    $user->user_email = $request->input('user_email');
    $user->user_type_id = $request->input('user_type_id');
    $user->staff_id = $request->input('staff_id');
    $user->is_active = $is_active;
    $user->last_login_time = now();
    $user->created_by = 1;
    $user->last_updated_by = 1;
    $user->save();
  

    return redirect()->route('user.index')->with('success', 'User updated successfully');   
}

public function destroy($id)
{
    $user = Mst_User::findOrFail($id);
    $user->delete();
    return 1;

    return redirect()->route('user.index')->with('success', 'User deleted successfully');

}

public function changeStatus(Request $request, $id)
{
    $user = Mst_User::findOrFail($id);

    $user->is_active = !$user->is_active;
    $user->save();
    return 1;

    return redirect()->back()->with('success','Status changed successfully');
}

}

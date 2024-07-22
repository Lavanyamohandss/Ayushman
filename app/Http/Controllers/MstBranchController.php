<?php

namespace App\Http\Controllers;
use App\Models\Mst_Branch;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MstBranchController extends Controller
{
   
public function index(Request $request)
{
  try{
    $pageTitle = "Branches";
    $query = Mst_Branch::query();

    // Apply filters if provided
    if ($request->has('branch_code')) {
        $query->where('branch_code', 'LIKE', "%{$request->branch_code}%");
    }

    if ($request->has('branch_name')) {
        $query->where('branch_name', 'LIKE', "%{$request->branch_name}%");
    }

    $branches = $query->orderBy('updated_at', 'desc')->get();
    return view('branches.index', compact('pageTitle', 'branches'));
 }catch (QueryException $e) {
    return redirect()->route('home')->with('error', 'Something went wrong.');
  }
}

    public function create()
    {
      try{
        $pageTitle = "Create Branch";
        return view('branches.create',compact('pageTitle'));
    }catch (QueryException $e) {
        return redirect()->route('branches')->with('error', 'Something went wrong.');
      }
    }

    public function store(Request $request)
{
    try{
    $request->validate([
        'branch_name' => 'required|unique:mst_branches',
        'branch_address' => 'required',
        'branch_contact_number' => 'nullable|numeric|digits:10',
        'branch_email' => 'nullable|email',
       // 'branch_admin_name' => 'required',
        'branch_admin_contact_number' => 'nullable|numeric|digits:10',
        'latitude' => 'required|regex:/^[0-9]+(\.[0-9]+)?$/',
        'longitude' =>'required|regex:/^[0-9]+(\.[0-9]+)?$/',
        'is_active' => 'required',
    ]);

    $is_active = $request->input('is_active') ? 1 : 0;

    $lastInsertedId = Mst_Branch::insertGetId([
    'branch_code' => rand(50, 100),
    'branch_name' => $request->branch_name,
    'branch_address' => $request->branch_address,
    'latitude' => $request->latitude,
    'longitude' => $request->longitude,
    'branch_contact_number' => $request->branch_contact_number,
    'branch_email' => $request->branch_email,
    'branch_admin_name' => $request->branch_admin_name,
    'branch_admin_contact_number' => $request->branch_admin_contact_number,
    'created_by' => auth()->id(),
    'is_active' =>  $is_active ,
  ]);

  $leadingZeros = str_pad('', 3 - strlen($lastInsertedId), '0', STR_PAD_LEFT);
  $branchCode = 'BC' . $leadingZeros . $lastInsertedId;

  Mst_Branch::where('branch_id', $lastInsertedId)->update([
      'branch_code' => $branchCode
  ]);
   
    return redirect()->route('branches')->with('success', 'Branch added successfully');
}catch (QueryException $e) {
    return redirect()->route('branches')->with('error', 'Something went wrong.');
  }
}


public function edit($id)
{
try{
    $pageTitle = "Edit Branch";
    $branch = Mst_Branch::findOrFail($id);
    return view('branches.edit', compact('pageTitle','branch'));
}catch (QueryException $e) {
    return redirect()->route('branches')->with('error', 'Something went wrong.');
  }
}

public function show($id)
{
  try{
    $pageTitle = "View branch details";
    $show = Mst_Branch::findOrFail($id);
    return view('branches.show',compact('pageTitle','show'));
}catch (QueryException $e) {
    return redirect()->route('branches')->with('error', 'Something went wrong.');
  }
}

public function update(Request $request, $id)
{
  try{
    $request->validate([
        'branch_name' => 'required',
        'branch_address' => 'required',
        'latitude' => 'required|regex:/^[0-9]+(\.[0-9]+)?$/',
        'longitude' =>'required|regex:/^[0-9]+(\.[0-9]+)?$/',
         'branch_contact_number' => 'nullable|numeric|digits:10',
         'branch_email' => 'nullable|email',
        // 'branch_admin_name' => 'required',
        'branch_admin_contact_number' => 'nullable|numeric|digits:10',
       
    ]);

    $is_active = $request->input('is_active') ? 1 : 0;

    $update = Mst_Branch::find($id);
    $update->update([
        'branch_name' => $request->branch_name,
        'branch_address' => $request->branch_address,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'branch_contact_number' => $request->branch_contact_number,
        'branch_email' => $request->branch_email,
        'branch_admin_name' => $request->branch_admin_name,
        'branch_admin_contact_number' => $request->branch_admin_contact_number,
        'is_active' =>  $is_active ,
    ]);

    return redirect()->route('branches')->with('success', 'Branch updated successfully');
}catch (QueryException $e) {
    return redirect()->route('branches')->with('error', 'Something went wrong.');
  }
}

public function destroy($id)
{
 try{
    $branch = Mst_Branch::findOrFail($id);
    $branch->delete();
    return 1;
    return redirect()->route('branches')->with('success', 'Branch deleted successfully');
}catch (QueryException $e) {
    return redirect()->route('branches')->with('error', 'Something went wrong.');
  }
}

public function changeStatus($id)
{
  try{
    $branch = Mst_Branch::findOrFail($id);

    $branch->is_active = !$branch->is_active;
    $branch->save();

    return 1;

    return redirect()->back()->with('success','Status changed successfully');
}catch (QueryException $e) {
    return redirect()->route('branches')->with('error', 'Something went wrong.');
  }
}
}

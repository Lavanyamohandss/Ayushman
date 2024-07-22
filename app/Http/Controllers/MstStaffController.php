<?php

namespace App\Http\Controllers;

use App\Models\Mst_Branch;
use App\Models\Mst_Master_Value;
use App\Models\Mst_Staff;
use App\Models\Sys_Salary_Type;
use App\Models\Mst_Staff_Transfer_Log;
use App\Models\Mst_Staff_Commission_Log;
use App\Models\Trn_Staff_Salary_History;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MstStaffController extends Controller
{
    public function index(Request $request)
    {
       
        $pageTitle = "staffs";
        $branch = Mst_Branch::pluck('branch_name','branch_id');
        $stafftype = Mst_Master_Value::where('master_id',4)->pluck('master_value','id');
        $query = Mst_Staff::query();

        if($request->has('staff_type')){
            $query->where('staff_type','LIKE',"%{$request->staff_type}%");
        }
        if($request->has('staff_name')){
            $query->where('staff_name','LIKE',"%{$request->staff_name}%");
        }
        if($request->has('staff_name')){
            $query->where('staff_name','LIKE',"%{$request->staff_name}%");
        }
        if($request->has('branch_id')){
            $query->where('branch_id','LIKE',"%{$request->branch_id}%");
        }
        if($request->has('contact_number')){
            $query->where('staff_contact_number','LIKE',"%{$request->contact_number}%");
        }
      
        $staffs = $query->orderBy('updated_at', 'desc')->get();
        return view('staffs.index',compact('pageTitle','staffs','branch','stafftype'));
    }

    public function create()
    {
        $pageTitle = "Create Staff";
        $stafftype = Mst_Master_Value::where('master_id',4)->pluck('master_value','id');
        $employmentType = Mst_Master_Value::where('master_id',5)->pluck('master_value','id');
        $gender = Mst_Master_Value::where('master_id',17)->pluck('master_value','id');
        $branch = Mst_Branch::pluck('branch_name','branch_id');
        $salaryType = Sys_Salary_Type::pluck('salary_type','id');
        $commissiontype = Mst_Master_Value::where('master_id',8)->pluck('master_value','id');
        return view('staffs.create',compact('pageTitle','stafftype','employmentType','gender','branch','commissiontype','salaryType'));
    }

    public function store(Request $request)
    {
        // print_r($request->all());die();
        $request->validate([
            'staff_type' => 'required',
            'employment_type' => 'required',
            // 'staff_username' => 'required',
            // 'password' => 'required',
            // 'confirm_password' => 'required|same:password',
            'staff_name' => 'required',
            'gender' => 'required',          
            // 'branch_id' => 'required|exists:mst_branches,branch_id',
            'date_of_birth' => 'required|date', 
            'staff_email' => 'sometimes|email|unique:mst_staffs',
            'staff_contact_number' => 'required',
            'staff_address' => 'required',
            'staff_qualification' => 'required',
           // 'staff_specialization' => 'required', 
            // 'staff_commission_type' => 'required',
            'staff_commission' => 'required|numeric', 
            'staff_booking_fee' => 'nullable|numeric|gt:0',
            'max_discount_value' => 'nullable|numeric|between:0,100',
            'salary_type' => 'required',
            'salary_amount' => 'required|numeric',
            'is_active' => 'required', 

         ]);
         $is_active = $request->input('is_active') ? 1 : 0;
         $is_login = $request->input('is_login') ? 1 : 0;
        
         $lastInsertedId = Mst_Staff::insertGetId([
            'staff_code' => rand(50, 100),
            'staff_type' => $request->staff_type,
            'employment_type' => $request->employment_type,
            'staff_username' => $is_login ? $request->staff_username : null,
            'password' => $is_login ? Hash::make($request->password) : null,
            'staff_name' => $request->staff_name,
            'gender' => $request->gender,
            'is_active' =>  $is_active ,
            'branch_id' => $request->branch_id,
            'date_of_birth' => $request->date_of_birth,
            'staff_email' => $request->staff_email,
            'staff_contact_number' => $request->staff_contact_number,
            'staff_address' => $request->staff_address,
            'staff_qualification' => $request->staff_qualification,
            'staff_specialization' => $request->staff_specialization,
            'staff_work_experience' => $request->staff_work_experience,
            'staff_commission_type' => $request->staff_commission_type,
            'staff_commission' => $request->staff_commission,
            'staff_booking_fee' => $request->staff_booking_fee,
            'max_discount_value' =>  $request->max_discount_value,
            'salary_type' => $request->salary_type,
            'salary_amount' => $request->salary_amount,
            'last_login_time' =>  Carbon::now(), 
            'created_by' => auth()->id(),

         ]);
        
         $leadingZeros = str_pad('', 3 - strlen($lastInsertedId), '0', STR_PAD_LEFT);
         $staffCode = 'SC' . $leadingZeros . $lastInsertedId;
       
     
         Mst_Staff::where('staff_id', $lastInsertedId)->update([
             'staff_code' => $staffCode
         ]);

         

         return redirect()->route('staffs.index')->with('success','Staff added successfully');
    }
 

    public function edit($staff_id)
    {
        $pageTitle = "Edit Staff";
        $staffs = Mst_Staff::findOrFail($staff_id);

        $stafftype = Mst_Master_Value::where('master_id',4)->pluck('master_value','id');
        $employmentType = Mst_Master_Value::where('master_id',5)->pluck('master_value','id');
        $gender = Mst_Master_Value::where('master_id',17)->pluck('master_value','id'); 
        $branch = Mst_Branch::pluck('branch_name','branch_id');
        $salaryType = Sys_Salary_Type::pluck('salary_type','id');
        $commissiontype = Mst_Master_Value::where('master_id',8)->pluck('master_value','id');
        return view('staffs.edit',compact('pageTitle','staffs','stafftype','employmentType','gender','branch','salaryType','commissiontype'));

    }

    public function update(Request $request, $staff_id)
    {
        $is_login = $request->input('is_login') ? 1 : 0;
        $is_active = $request->input('is_active') ? 1 : 0;

        //staff-transfer-logs:
        $existing = Mst_Staff::where('staff_id', $staff_id)->value('branch_id');
        $updating = $request->branch_id;

        //staff-commission-logs:
        $existingCommission = Mst_Staff::where('staff_id', $staff_id)->value('staff_commission');
        $updatedCommission = $request->staff_commission;

        //staff-salary-updation:
        $existingSalary = Mst_Staff::where('staff_id', $staff_id)->value('salary_amount');
        $updatedSalary = $request->salary_amount;
   
        $update = Mst_Staff::find($staff_id);
      
        $update->update([
            'staff_type' => $request->staff_type,
            'employment_type' => $request->employment_type,
           
            'staff_name' => $request->staff_name,
            'gender' => $request->gender,
            'is_active' => $is_active,
            'branch_id' => $request->branch_id,
            'date_of_birth' => $request->date_of_birth,
            'staff_email' => $request->staff_email,
            'staff_contact_number' => $request->staff_contact_number,
            'staff_address' => $request->staff_address,
            'staff_qualification' => $request->staff_qualification,
            'staff_specialization' => $request->staff_specialization,
            'staff_work_experience' => $request->staff_work_experience,
            'staff_commission_type' => $request->staff_commission_type,
            'staff_commission' => $request->staff_commission,
            'staff_booking_fee' => $request->staff_booking_fee,
            'max_discount_value' =>  $request->max_discount_value,
            'salary_type' => $request->salary_type,
            'salary_amount' => $request->salary_amount,
        ]);
        if($request->has('staff_username') && !empty($request->staff_username)){
            $update->update([
                'staff_username' => $request->staff_username,
            ]);
        }
    
        if ($request->has('password') && !empty($request->password)) {
            // Hash and update the password only if a new password is provided
            $update->update([
                'password' => Hash::make($request->password),
            ]);
        }
    
        if ($existing != $updating) {
            $createdBy = auth()->id();
            $transfer =  Mst_Staff_Transfer_Log::create([
                'staff_id' => $staff_id,
                'branch_id_from' => $existing,
                'branch_id_to' => $request->branch_id,
                'transfer_date' => Carbon::now(),
                'created_by' => $createdBy,
            ]);
        }
    
        if ($existingCommission != $updatedCommission) {
            $commission = Mst_Staff_Commission_Log::create([
                'staff_id' => $staff_id,
                'commission_type' => $request->staff_commission_type,
                'staff_commission' => $updatedCommission,
                'commission_change_date' => Carbon::now(),
                'created_by' => auth()->id(),
            ]);
        }

        if($existingSalary != $updatedSalary){
            $salary = Trn_Staff_Salary_History::create([
                'staff_id' => $staff_id,
                'old_salary' => $existingSalary,
                'new_salary' => $request->salary_amount,
                'updated_date' => carbon::now(),
                'created_by' => auth()->id(),

            ]);
        }
    
        return redirect()->route('staffs.index')->with('success', 'Staff updated successfully');
    }
    

    public function show($id)
    {
        try{
            $pageTitle = "View staff details";
            $show = Mst_Staff::findOrFail($id);
            return view('staffs.show',compact('pageTitle','show'));
        }catch (QueryException $e) {
            return redirect()->route('branches')->with('error', 'Something went wrong.');
          }
    }
      

    public function destroy($staff_id)
    {
        $staff = Mst_Staff::findOrFail($staff_id);
        $staff->delete();
        return 1;

        return redirect()->route('staffs.index')->with('success','Staff deleted successfully');
    }

    public function changeStatus(Request $request, $staff_id)
    {
        $staff = Mst_Staff::findOrFail($staff_id);
    
        $staff->is_active = !$staff->is_active;
        $staff->save();
    
        return redirect()->back()->with('success','Status changed successfully');
    }
}

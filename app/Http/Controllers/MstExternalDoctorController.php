<?php

namespace App\Http\Controllers;
use App\Models\Mst_External_Doctor;
use App\Models\Mst_Branch;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class MstExternalDoctorController extends Controller
{
    public function index(Request $request)
{
    try{
        $pageTitle = "External Doctors";
        $externaldoctor =  Mst_External_Doctor::latest()->get();
         return view('externalDoctors.index', compact('pageTitle','externaldoctor'));
        }catch (QueryException $e) {
            return redirect()->route('home')->with('error', 'Something went wrong.');
        }
    }
   

    public function create()
    {
        try{
            $pageTitle = "Create External Doctor";
            return view('externalDoctors.create',compact('pageTitle'));
        }catch (QueryException $e) {
            return redirect()->route('externaldoctors.index')->with('error', 'Something went wrong.');
        }
    }
      

    public function store(Request $request)
    {
        try{
            $request->validate([
                'doctor_name' => 'required',
                'contact_no' => 'required|numeric|digits:10',
                'contact_email' => 'nullable|email',
                'commission' => 'nullable|numeric|between:0,100',
                'is_active' => 'required',
            ]);
            
        $is_active = $request->input('is_active')? 1 : 0;
           
            $doctor = new Mst_External_Doctor();
            $doctor->doctor_name = $request->input('doctor_name');
            $doctor->contact_no = $request->input('contact_no');
            $doctor->contact_email = $request->input('contact_email');
            $doctor->address = $request->input('address');
            $doctor->remarks = $request->input('remarks');
            $doctor->commission = $request->input('commission');
            $doctor->is_active = $is_active; 
            $doctor->save();
        
            return redirect()->route('externaldoctors.index')->with('success','External doctor added successfully');
        }catch (QueryException $e) {
            return redirect()->route('externaldoctors.index')->with('error', 'Something went wrong.');
        }
    }
        
      

    public function edit($id)
    {
        try{
            $pageTitle = "Edit External Doctor";
            $doctor = Mst_External_Doctor::findOrFail($id);
            return view('externalDoctors.edit', compact('pageTitle','doctor'));
        }catch (QueryException $e) {
            return redirect()->route('externaldoctors.index')->with('error', 'Something went wrong.');
        }
        }
      

    public function update(Request $request ,$id)
    {
        try{
            $request->validate([
            'doctor_name' => 'required',
            'contact_no' => 'required',
            'contact_email' => 'nullable|email',
            'commission' => 'nullable|numeric|between:0,100',
           
        ]);
        
        $is_active = $request->input('is_active')? 1 : 0;
       
        $doctor =  Mst_External_Doctor::findOrFail($id);
        $doctor->doctor_name = $request->input('doctor_name');
        $doctor->contact_no = $request->input('contact_no');
        $doctor->contact_email = $request->input('contact_email');
        $doctor->address = $request->input('address');
        $doctor->remarks = $request->input('remarks');
        $doctor->commission = $request->input('commission');
        $doctor->is_active = $is_active; 
        $doctor->save();
    
        return redirect()->route('externaldoctors.index')->with('success','External doctor updated successfully');
    }catch (QueryException $e) {
        return redirect()->route('externaldoctors.index')->with('error', 'Something went wrong.');
    }
}
        

    public function show($id)
    {
        try{
            $pageTitle = "External doctor details";
            $show =  Mst_External_Doctor::findOrFail($id);
            return view('externalDoctors.show',compact('pageTitle','show'));
        }catch (QueryException $e) {
            return redirect()->route('externaldoctors.index')->with('error', 'Something went wrong.');
        }
        }
      

    public function destroy($id)
    {
        try{
            $doctor =  Mst_External_Doctor::findOrFail($id);
            $doctor->delete();
            return 1;
    
            return redirect()->route('externaldoctors.index')->with('success','External doctor deleted successfully');
        }catch (QueryException $e) {
            return redirect()->route('externaldoctors.index')->with('error', 'Something went wrong.');
        }
    
        }
      
    public function changeStatus(Request $request, $id)
{
    try{
        $doctor = Mst_External_Doctor::findOrFail($id);

        $doctor->is_active = !$doctor->is_active;
        $doctor->save();
        return 1;
    
        return redirect()->back()->with('success','Status changed successfully');
    }catch (QueryException $e) {
        return redirect()->route('externaldoctors.index')->with('error', 'Something went wrong.');
    }
    }
   

}

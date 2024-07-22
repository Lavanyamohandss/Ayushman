<?php

namespace App\Http\Controllers;
use App\Models\Mst_Medicine;
use App\Models\Mst_Tax_Group;
use App\Models\Mst_Branch;
use App\Models\Mst_Master_Value;
use App\Models\Mst_Tax;
use App\Models\Mst_Unit;
use Illuminate\Http\Request;

class MstMedicineController extends Controller
{
    public function index(Request $request)
    {
        $pageTitle = "Medicines";
        $medicineType =  Mst_Master_Value::where('master_id',14)->pluck('master_value','id');
        $query = Mst_Medicine::query();

        if($request->has('medicine_name')){
            $query->where('medicine_name','LIKE',"%{$request->medicine_name}%");
        }
       
        if($request->has('generic_name')){
            $query->where('generic_name','LIKE',"%{$request->generic_name}%");
        }
        if($request->has('medicine_type')){
            $query->where('medicine_type','LIKE',"%{$request->medicine_type}%");
        }
        
        // if ($request->filled('branch')) {
        //     $query->whereHas('branch', function ($q) use ($request) {
        //         $q->where('branch_name', 'like', '%' . $request->input('branch') . '%');
        //     });
        // }
        if($request->has('contact_number')){
            $query->where('staff_contact_number','LIKE',"%{$request->contact_number}%");
        }
        // if ($request->filled('manufacturer')) {
        //     $query->whereHas('Manufacturer', function ($q) use ($request) {
        //         $q->where('master_value', 'like', '%' . $request->input('manufacturer') . '%');
        //     });
        // }
        $medicines = $query->orderBy('updated_at', 'desc')->get();
        return view('medicine.index', compact('pageTitle', 'medicines','medicineType'));
    }

    public function create()
    {
        $pageTitle = "Create Medicine";
        $itemType = Mst_Master_Value::where('master_id',13)->pluck('master_value','id');
        $medicineType =  Mst_Master_Value::where('master_id',14)->pluck('master_value','id');
        // $dosageForm =  Mst_Master_Value::where('master_id',15)->pluck('master_value','id');
        $Manufacturer =  Mst_Master_Value::where('master_id',16)->pluck('master_value','id');
        // $branches = Mst_Branch::pluck('branch_name','branch_id'); 
        $taxes = Mst_Tax_Group::pluck('tax_group_name','id');
        $units = Mst_Unit::pluck('unit_name','id');

        return view('medicine.create', compact('pageTitle','taxes','itemType','medicineType','Manufacturer','units'));
    }

    public function store(Request $request)
    {
        $request->validate([
          
            'medicine_name' => 'required',
            'generic_name' => 'required',
            'item_type' => 'required',
            'medicine_type' => 'required',
            'tax_id' => 'required|exists:mst_taxes,id',
            'unit_price' => 'required',
            'description' => 'required',
            'unit_id' => 'required|exists:mst_units,id',
            'is_active' => 'required',
          
           
            ]);
        $is_active = $request->input('is_active') ? 1 : 0;
    
         $medicines = new Mst_Medicine();
         $medicines->medicine_name = $request->input('medicine_name');
         $medicines->generic_name = $request->input('generic_name');
         $medicines->item_type = $request->input('item_type');
         $medicines->medicine_type = $request->input('medicine_type');
         $medicines->Hsn_code = $request->input('Hsn_code');
         $medicines->tax_id = $request->input('tax_id');
         $medicines->manufacturer = $request->input('manufacturer');
         $medicines->unit_price = $request->input('unit_price');
         $medicines->description = $request->input('description');
         $medicines->unit_id = $request->input('unit_id');
         $medicines->is_active =  $is_active ;
         $medicines->reorder_limit = $request->input('reorder_limit');
         $medicines->created_by = auth()->id();
         $medicines->save();
       
    
         return redirect()->route('medicine.index')->with('success','Medicine added successfully');
    }

    public function edit($id)
    {
        $pageTitle = "Edit Medicine";
        $medicine = Mst_Medicine::findOrFail($id);
        $itemType = Mst_Master_Value::where('master_id',13)->pluck('master_value','id');
        $medicineType =  Mst_Master_Value::where('master_id',14)->pluck('master_value','id');
       // $dosageForm =  Mst_Master_Value::where('master_id',15)->pluck('master_value','id');
        $manufacturer =  Mst_Master_Value::where('master_id',16)->pluck('master_value','id');
        //$branches = Mst_Branch::pluck('branch_name','branch_id'); 
        $taxes = Mst_Tax_Group::pluck('tax_group_name','id');
        $units = Mst_Unit::pluck('unit_name','id');

        return view('medicine.edit', compact('pageTitle','medicine','taxes','itemType','medicineType','manufacturer','units'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
        
            'medicine_name' => 'required',
            'generic_name' => 'required',
            'item_type' => 'required',
            'medicine_type' => 'required',
            'tax_id' => 'required|exists:mst_taxes,id',      
            'unit_price' => 'required',
            'description' => 'required',
            'unit_id' => 'required|exists:mst_units,id',
            'is_active' => 'required',         
            //'branch_id' =>  'required|exists:mst_branches,branch_id',
           
           
            ]);
        $is_active = $request->input('is_active') ? 1 : 0;
    
       
        $medicine = Mst_Medicine::findOrFail($id);

        $medicine->medicine_name = $request->input('medicine_name');
        $medicine->generic_name = $request->input('generic_name');
        $medicine->item_type = $request->input('item_type');
        $medicine->medicine_type = $request->input('medicine_type');
        $medicine->Hsn_code = $request->input('Hsn_code');
        $medicine->tax_id = $request->input('tax_id');
        //$medicine->dosage_form = $request->input('dosage_form');
        $medicine->manufacturer = $request->input('manufacturer');
        $medicine->unit_price = $request->input('unit_price');
        $medicine->description = $request->input('description');
        $medicine->unit_id = $request->input('unit_id');
        $medicine->is_active =  $is_active ;
        $medicine->reorder_limit = $request->input('reorder_limit');
       //$medicine->branch_id = $request->input('branch_id');
        $medicine->save();
    
        return redirect()->route('medicine.index')->with('success','Medicine updated successfully'); 
    }

    public function show($id)
    {
        $pageTitle = "View medicine details";
        $show = Mst_Medicine::findOrFail($id);
        return view('medicine.show',compact('pageTitle','show'));
    }
     
    public function destroy($id)
    {
        $medicine = Mst_Medicine::findOrFail($id);
        $medicine->delete();
        return 1;

        return redirect()->route('medicine.index')->with('success','Medicine deleted successfully');
    }

    public function changeStatus(Request $request, $id)
    {
        $medicine = Mst_Medicine::findOrFail($id);
    
        $medicine->is_active = !$medicine->is_active;
        $medicine->save();
        return 1;
        return redirect()->back()->with('success','Status changed successfully');
    }

}

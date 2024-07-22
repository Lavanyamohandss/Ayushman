<?php

namespace App\Http\Controllers;
use App\Models\Mst_Medicine_Category;
use Illuminate\Http\Request;

class MstMedicineCategoryController extends Controller
{
    public function index()
    {
        $pageTitle = "Medicine Categories";
        $categories = Mst_Medicine_Category::latest()->get();
        return view('medicinecategory.index',compact('pageTitle','categories'));
    }

    public function create()
    {
        $pageTitle = "Create Medicine Category";
        return view('medicinecategory.create',compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'is_active' => 'required',
        ]);
        $is_active = $request->input('is_active') ? 1 : 0;
    
       
        $categories = new Mst_Medicine_Category();
        $categories->category_name = $request->input('category_name');
        $categories->is_active = $is_active;
        $categories->save();
    
        return redirect()->route('medicinecategory.index')->with('success','Medicine Category added successfully');
    }

    public function edit($id)
    {
        $pageTitle = "Edit Medicine Category";
        $categories = Mst_Medicine_Category::findOrFail($id);
        return view('medicinecategory.edit',compact('pageTitle','categories'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'category_name' => 'required',
           
        ]);
        $is_active = $request->input('is_active') ? 1 : 0;
    
       
        $categories =  Mst_Medicine_Category::findOrFail($id);
        $categories->category_name = $request->input('category_name');
        $categories->is_active = $is_active;
        $categories->save();
    
        return redirect()->route('medicinecategory.index')->with('success','Medicine Category updated successfully');
    }

    public function destroy($id)
    {
        $categories =  Mst_Medicine_Category::findOrFail($id);
        $categories->delete();

        return redirect()->route('medicinecategory.index')->with('success','Medicine Category deleted successfully');
    }

    public function changeStatus(Request $request, $id)
    {
        $categories = Mst_Medicine_Category::findOrFail($id);

        $categories->is_active = !$categories->is_active;
        $categories->save();

        return redirect()->back()->with('success','Status changed successfully');
    }

}

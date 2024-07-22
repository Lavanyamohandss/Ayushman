<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Sys_Account_Group;
use App\Models\Mst_Account_Sub_Head;
use Carbon\Carbon;

class AccountSubGroupController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageTitle = "Account Sub Groups";
            $account_sub_groups = Mst_Account_Sub_Head::get();
            return view('account_sub_group.index', compact('pageTitle', 'account_sub_groups'));
        } catch (QueryException $e) {
            return redirect()->route('home')->with('error', 'Something went wrong');
        }
    }

    public function create()
    {
        try {
            $pageTitle = "Create Account Sub Groups";
            $account_groups = Sys_Account_Group::where('is_active', 1)->get();
            return view('account_sub_group.create', compact('pageTitle', 'account_groups'));
        } catch (QueryException $e) {
            return redirect()->route('account.sub.group.index')->with('error', 'Something went wrong');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'account_group_id' => 'required',
                'sub_group_name' => 'required',
                'is_active' => 'required',
            ]);

            $is_exists = Mst_Account_Sub_Head::where('account_sub_group_name', $request->input('sub_group_name'))->where('account_group_id', $request->input('account_group_id'))->first();
            if ($is_exists) {
                return redirect()->route('account.sub.group.index')->with('error', 'This sub group name is already exists.');
            } else {
                $is_active = $request->input('is_active') ? 1 : 0;


                $account_sub_group = new Mst_Account_Sub_Head();
                $account_sub_group->account_group_id = $request->input('account_group_id');
                $account_sub_group->account_sub_group_name = $request->input('sub_group_name');
                $account_sub_group->is_active = $is_active;
                $account_sub_group->created_by = auth()->id();
                $account_sub_group->updated_by = auth()->id();
                $account_sub_group->created_at = Carbon::now();
                $account_sub_group->updated_at = Carbon::now();
                $account_sub_group->save();

                return redirect()->route('account.sub.group.index')->with('success', 'Sub group name added successfully');
            }
        } catch (QueryException $e) {
            return redirect()->route('account.sub.group.index')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $pageTitle = "Edit Account Sub Groups";
            $account_groups = Sys_Account_Group::where('is_active', 1)->get();
            $account_sub_groups = Mst_Account_Sub_Head::findOrFail($id);
            return view('account_sub_group.edit', compact('pageTitle', 'account_sub_groups', 'account_groups'));
        } catch (QueryException $e) {
            return redirect()->route('account.sub.group.index')->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'account_group_id' => 'required',
                'sub_group_name' => 'required',
                'is_active' => 'required',
            ]);
            $is_exists = Mst_Account_Sub_Head::where('account_sub_group_name', $request->input('sub_group_name'))->where('account_group_id', $request->input('account_group_id'))
                ->where('id', '!$id')->first();

            if ($is_exists) {
                return redirect()->route('account.sub.group.index')->with('error', 'This sub group name is already exists.');
            } else {
                $is_active = $request->input('is_active') ? 1 : 0;

                $account_sub_group = Mst_Account_Sub_Head::findOrFail($id);
                $account_sub_group->account_group_id = $request->input('account_group_id');
                $account_sub_group->account_sub_group_name = $request->input('sub_group_name');
                $account_sub_group->is_active = $is_active;
                $account_sub_group->updated_by = auth()->id();
                $account_sub_group->updated_at = Carbon::now();
                $account_sub_group->save();

                return redirect()->route('account.sub.group.index')->with('success', 'Sub group name updated successfully');
            }
        } catch (QueryException $e) {
            return redirect()->route('account.sub.group.index')->with('error', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        try {
            $accout_sub_group =  Mst_Account_Sub_Head::findOrFail($id);
            $accout_sub_group->delete();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('account.sub.group.index')->with('error', 'Something went wrong');
        }
    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $accout_sub_group = Mst_Account_Sub_Head::findOrFail($id);
            $accout_sub_group->is_active = !$accout_sub_group->is_active;
            $accout_sub_group->save();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('account.sub.group.index')->with('error', 'Something went wrong');
        }
    }
}

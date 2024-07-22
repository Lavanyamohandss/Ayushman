<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Sys_Account_Group;
use App\Models\Mst_Account_Sub_Head;
use App\Models\Mst_Account_Ledger;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class AccountLedgerController extends Controller
{
    public function index(Request $request)
    {
        try {
            $pageTitle = "Account Ledger";
            $account_ledgers = Mst_Account_Ledger::join('mst_account_sub_head', 'mst__account__ledgers.account_sub_group_id', 'mst_account_sub_head.id')
            ->select('mst__account__ledgers.id', 'mst__account__ledgers.ledger_name', 'mst__account__ledgers.ledger_name', 'mst__account__ledgers.ledger_code', 'mst__account__ledgers.is_active', 'mst_account_sub_head.account_sub_group_name')
            ->orderBy('mst__account__ledgers.created_at', 'desc')
            ->get();
        
                
            return view('account_ledger.index', compact('pageTitle', 'account_ledgers'));
        } catch (QueryException $e) {
            return redirect()->route('account.ledger.index')->with('error', 'Something went wrong');
        }
    }

    public function create()
    {
        try {
            $pageTitle = "Create Account Ledger";
            $account_groups = Sys_Account_Group::where('is_active', 1)->get();
            return view('account_ledger.create', compact('pageTitle', 'account_groups'));
        } catch (QueryException $e) {
            return redirect()->route('account.ledger.index')->with('error', 'Something went wrong');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'account_group_id' => 'required',
                'account_sub_group_id' => 'required',
                'ledger_name' => 'required',
                'ledger_notes' => 'required',
                'is_active' => 'required',
            ]);

            $is_exists = Mst_Account_Ledger::where('account_sub_group_id', $request->input('account_sub_group_id'))->where('ledger_name', $request->input('ledger_name'))->first();
            if ($is_exists) {
                return redirect()->route('account.ledger.index')->with('error', 'This ledger is already exists.');
            } else {
                $is_active = $request->input('is_active') ? 1 : 0;

                $lastInsertedId = Mst_Account_Ledger::insertGetId([
                    'account_sub_group_id' => $request->input('account_sub_group_id'),
                    'ledger_name' => $request->input('ledger_name'),
                    'ledger_code' => 1,
                    'notes' => $request->input('ledger_notes'),
                    'is_active' => $is_active,
                    'created_by' => auth()->id(),
                    'updated_by' => auth()->id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                $code =  Config::get('settings.ledger_code');
                $zeroes = Config::get('settings.zeroes');
                $leadingZeros = str_pad('', $zeroes - strlen($lastInsertedId), '0', STR_PAD_LEFT);
                $ledger_code =  $code.$leadingZeros.$lastInsertedId;
                Mst_Account_Ledger::where('id', $lastInsertedId)->update([
                    'ledger_code' => $ledger_code,
                    'updated_at' => Carbon::now(),
                ]);
                

                return redirect()->route('account.ledger.index')->with('success', 'Ledger added successfully');
            }
        } catch (QueryException $e) {
            return redirect()->route('account.ledger.index')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $pageTitle = "Edit Account Ledger";
            $account_groups = Sys_Account_Group::where('is_active', 1)->get();
            $account_ledger = Mst_Account_Ledger::find($id);
            $account_sub_group = Mst_Account_Sub_Head::find($account_ledger->account_sub_group_id);
            $subgroup_options = Mst_Account_Sub_Head::where('account_group_id', $account_sub_group->account_group_id)
                ->where('is_active', 1)
                ->get();
            if (!$account_ledger) {
                // Handle the case where the ledger with the given ID doesn't exist
                return redirect()->route('account.ledger.index')->with('error', 'Account ledger not found');
            }
            return view('account_ledger.edit', compact('pageTitle','subgroup_options', 'account_ledger', 'account_groups','account_sub_group'));
        } catch (QueryException $e) {
            return redirect()->route('account.ledger.index')->with('error', 'Something went wrong');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'account_group_id' => 'required',
                'account_sub_group_id' => 'required',
                'ledger_name' => 'required',
                'ledger_notes' => 'required',
                'is_active' => 'required',
            ]);

            $is_exists = Mst_Account_Ledger::where('account_sub_group_id', $request->input('account_sub_group_id'))
            ->where('ledger_name', $request->input('ledger_name'))
            ->where('id',!$id)
            ->first();
            if ($is_exists) {
                return redirect()->route('account.ledger.index')->with('error', 'This ledger is already exists.');
            } else {
                $is_active = $request->input('is_active') ? 1 : 0;

                $account_ledger =  Mst_Account_Ledger::findorfail($id);
                $account_ledger->account_sub_group_id = $request->input('account_sub_group_id');
                $account_ledger->ledger_name = $request->input('ledger_name');
                $account_ledger->ledger_code = 1;
                $account_ledger->notes = $request->input('ledger_notes');
                $account_ledger->is_active = $is_active;
                $account_ledger->created_by = auth()->id();
                $account_ledger->updated_by = auth()->id();
                $account_ledger->created_at = Carbon::now();
                $account_ledger->updated_at = Carbon::now();
                $account_ledger->save();

                return redirect()->route('account.ledger.index')->with('success', 'Ledger added successfully');
            }
        } catch (QueryException $e) {
            return redirect()->route('account.ledger.index')->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $accout_ledger =  Mst_Account_Ledger::findOrFail($id);
            $accout_ledger->delete();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('account.ledger.index')->with('error', 'Something went wrong');
        }
    }

    public function changeStatus($id)
    {
        try {
            $accout_ledger = Mst_Account_Ledger::findOrFail($id);
            $accout_ledger->is_active = !$accout_ledger->is_active;
            $accout_ledger->save();
            return 1;
        } catch (QueryException $e) {
            return redirect()->route('account.ledger.index')->with('error', 'Something went wrong');
        }
    }

    public function getAccountSubGroups($id)
    {
        try {
            // Fetch account sub groups based on the selected account group
            $account_sub_groups = Mst_Account_Sub_Head::where('account_group_id', $id)
                ->where('is_active', 1)
                ->get();
            // Prepare data to return as JSON response
            $data = [];
            foreach ($account_sub_groups as $sub_group) {
                $data[$sub_group->id] = $sub_group->account_sub_group_name;
            }
            return response()->json($data);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}

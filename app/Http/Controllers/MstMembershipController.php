<?php

namespace App\Http\Controllers;

use App\Models\Mst_Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Mst_Membership_Package;
use App\Models\Mst_Membership_Benefit;
use App\Models\Mst_Membership_Package_Wellness;
use App\Models\Mst_Wellness;
use App\Models\Mst_Patient_Membership_Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MstMembershipController extends Controller
{
    public function index()
    {
        $pageTitle = "Membership Packages";
        $memberships = Mst_Membership_Package::orderBy('created_at', 'desc')->get();
        return view('membership.index', compact('pageTitle', 'memberships'));
    }


    public function create()
    {
        $pageTitle = "Create Membership Packages";
        $wellnesses = Mst_Wellness::where('is_active', 1)->get();
        return view('membership.create', compact('pageTitle', 'wellnesses'));
    }

    public function store(Request $request)
    {
        print_r($request->all());die();
        $validator = Validator::make(
            $request->all(),
            [
                'membership_package_name' => ['required'],
                'membership_package_duration' => ['required'],
                'membership_package_price' => ['required'],
                'discount_price' => ['required'],
                'membership_package_description' => ['required'],
                'membership_package_active' => ['required'],
                'wellness_id' => ['required'],
                'max_limit' => ['required'],
                'benefits' => ['required'],
            ],
            [
                'membership_package_name.required' => 'Membership package name is required',
                'membership_package_duration.required' => 'Membership package duration is required',
                'membership_package_price.required' => 'Membership package price is required',
                'discount_price.required' => 'Discount price is required',
                'membership_package_description.required' => 'Membership package description is required',
                'membership_package_active.required' => 'Membership package status is required',
                'wellness_id.required' => 'Atleast one wellness is required',
                'max_limit.required' => 'Wellness max usage limit is required',
                'benefits.required' => 'Membership package benefits is required',
            ]
        );

        if (!$validator->fails()) {
            $lastInsertedId = Mst_Membership_Package::insertGetId([
                'package_title'      => $request->membership_package_name,
                'package_duration'     => $request->membership_package_duration,
                'package_description'   => $request->membership_package_description,
                'package_price'    => $request->membership_package_price,
                'package_discount_price'    => $request->discount_price,
                'is_active'       => $request->membership_package_active,
                'created_by'    => Auth::id(),
                'updated_by'          => Auth::id(),
                'created_at'         => Carbon::now(),
                'updated_at'         => Carbon::now(),
            ]);


            for ($i = 0; $i < count($request->wellness_id); $i++) {
                $checkWellness = Mst_Membership_Package_Wellness::where('package_id', $lastInsertedId)->where('wellness_id', $request->wellness_id[$i])->first();
                if (!$checkWellness) {
                    $addMembershipBenefits = Mst_Membership_Package_Wellness::create([
                        'package_id' => $lastInsertedId,
                        'wellness_id' => $request->wellness_id[$i],
                        'maximum_usage_limit' => $request->max_limit[$i],
                        'is_active' => 1,
                        'created_by' => Auth::id(),
                        'updated_by' => Auth::id(),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }

            $checkBenefits = Mst_Membership_Benefit::where('package_id', $lastInsertedId)->where('title', $request->benefits[$i])->first();
            if (!$checkBenefits) {
                $addMembershipBenefits = Mst_Membership_Benefit::create([
                    'package_id' => $lastInsertedId,
                    'title' => $request->benefits,
                    'is_active' => 1,
                    'created_by' => Auth::id(),
                    'updated_by' => Auth::id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
            return redirect()->route('membership.index')->with('success', 'Membership package added successfully');
        } else {
            $messages = $validator->errors();
            return redirect()->route('membership.create')->with('error', $messages);
        }
    }

    public function edit($id, $active_tab)
    {
        $pageTitle = "Edit Membership Packages";
        $membership = Mst_Membership_Package::findOrFail($id);
        $wellnesses = Mst_Wellness::where('is_active', 1)->get();
        $included_wellness = Mst_Membership_Package_Wellness::join('mst_wellness', 'mst__membership__package__wellnesses.wellness_id', 'mst_wellness.wellness_id')
            ->select('mst__membership__package__wellnesses.package_id', 'mst__membership__package__wellnesses.package_wellness_id', 'mst__membership__package__wellnesses.maximum_usage_limit', 'mst__membership__package__wellnesses.is_active', 'mst_wellness.wellness_name',)
            ->where('mst__membership__package__wellnesses.package_id', $id)
            ->get();
        $included_benefits = Mst_Membership_Benefit::where('package_id', $id)->get();
        return view('membership.edit', compact('pageTitle', 'membership', 'wellnesses', 'included_benefits', 'included_wellness', 'active_tab'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'update_type' => 'required',
            ],
            [
                'update_type.required' => 'Update type is required',
            ]
        );

        if (!$validator->fails()) {
            if (!empty($request->update_type)) {
                if ($request->update_type == 1) {
                    $membershipPackage = Mst_Membership_Package::find($id);
                    if ($membershipPackage) {
                        $membershipPackage->update([
                            'package_title'      => $request->membership_package_name,
                            'package_duration'   => $request->membership_package_duration,
                            'package_description' => $request->membership_package_description,
                            'package_price'      => $request->membership_package_price,
                            'package_discount_price' => $request->discount_price,
                            'is_active'          => $request->membership_package_active,
                            'updated_by'         => Auth::id(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                    return redirect()->route('membership.index')->with('success', 'Membership package updated successfully');
                } elseif ($request->update_type == 2) {
                    // checking the exists or not , i.e, here no edit option only delete and add option 
                    $checkExists = Mst_Membership_Package_Wellness::where('package_id', $id)->where('wellness_id', $request->wellness_id)->first();

                    if (!$checkExists) {
                        $updateWellness = Mst_Membership_Package_Wellness::create([
                            'package_id' => $id,
                            'wellness_id' => $request->wellness_id,
                            'maximum_usage_limit' => $request->max_usage_limit,
                            'is_active' => 1,
                            'created_by' => Auth::id(),
                            'updated_by' => Auth::id(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        $message = "A wellness included with this membership package successfully";
                        $status = 'success';
                    } else {
                        $message = "This wellness is already included in this package";
                        $status = 'error';
                    }
                    return redirect()->route('membership.edit', ['id' => $id, 'active_tab' => 2])->with($status, $message);
                } else {

                    $checkExists = Mst_Membership_Benefit::where('package_id', $id)->first();
                    if($checkExists && !empty($checkExists->title)){
                        $html1 = $checkExists->title;

                        $html2 = $request->benefit_title;
                        // Extract the list items from both HTML strings
                        preg_match_all('/<li>(.*?)<\/li>/', $html1, $matches1);
                        preg_match_all('/<li>(.*?)<\/li>/', $html2, $matches2);
    
                        // Combine the matches into a single array
                        $combinedItems = array_merge($matches1[1], $matches2[1]);
    
                        // Remove duplicates while preserving the order
                        $uniqueItems = array_values(array_unique($combinedItems));
    
                        // Build the merged HTML list
                        $mergedHtml = '<ul>';
                        foreach ($uniqueItems as $item) {
                            $mergedHtml .= "<li>$item</li>";
                        }
                        $mergedHtml .= '</ul>';

                        if ($mergedHtml) {
                            $updateMembershipBenefits = Mst_Membership_Benefit::where('package_id', $id)->update([
                                'title' => $mergedHtml,
                                'is_active' => 1,
                                'created_by' => Auth::id(),
                                'updated_by' => Auth::id(),
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                            $message = "Benefits updated successfully";
                            $status = 'success';
                        } else {
                            $message = "Someting went wrong";
                            $status = 'error';
                        }
                    }else{
                        $updateMembershipBenefits = Mst_Membership_Benefit::create([
                            'package_id' => $id,
                            'title' => $request->benefit_title,
                            'is_active' => 1,
                            'created_by' => Auth::id(),
                            'updated_by' => Auth::id(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        $message = "Benefits added successfully";
                        $status = 'success';
                    }
                    return redirect()->route('membership.edit', ['id' => $id, 'active_tab' => 3])->with($status, $message);
                }
            } else {
                return redirect()->route('membership.edit', ['id' => $id])->with('success', 'Please provide mandatory fields');
            }
        } else {
            $message = $validator->errors();
            return redirect()->route('membership.edit', ['id' => $id, 'active_tab' => 1])->with('validation error', $message);
        }
    }

    public function destroyMembershipPackage($id)
    {
        $data = Mst_Membership_Package::where('membership_package_id', $id)->first();

        if ($data) {
            $checkExists = Mst_Patient_Membership_Booking::where('membership_package_id', $id)
                ->where('membership_expiry_date', '>=', Carbon::now())
                ->get();

            if ($checkExists->isEmpty()) {
                // No matching records found, safe to delete
                $membership = Mst_Membership_Package::where('membership_package_id', $id)->delete();
                return 1;
                // return redirect()->route('membership.index')->with('success', 'Deleted successfully');
            } else {
                return 2;
                // return redirect()->route('membership.index')->with('error', 'Cannot delete this item because it is already in use by some users.');
            }
        }
        return 3;
        // return redirect()->route('membership.index')->with('success', 'Something went wrong');
    }

    public function deleteWellness($id)
    {
        $data = Mst_Membership_Package_Wellness::where('package_wellness_id', $id)->first();
        if ($data) {
            $checkExists = Mst_Patient_Membership_Booking::where('membership_package_id', $data->package_id)
                ->where('membership_expiry_date', '>=', Carbon::now())
                ->where('created_at', '>=', $data->created_at)
                ->get();
            if ($checkExists->isEmpty()) {
                // No matching records found, safe to delete
                $membership = Mst_Membership_Package_Wellness::where('package_wellness_id', $id)->delete();
                    return 1;
                // return redirect()->route('membership.edit')->with('success', 'Deleted successfully');
            } else {
                return 2;
                // return redirect()->route('membership.edit', ['id' => $data->package_id, 'active_tab' => 2])->with('error', 'Cannot delete this item because it is already in use by some users.');
            }
        }
        return 3;
        // return redirect()->route('membership.edit', ['id' => $data->package_id, 'active_tab' => 2])->with('success', 'Something went wrong');
    }

    public function deleteBenefit($id)
    {

        $data = Mst_Membership_Benefit::where('membership_benefits_id', $id)->first();
        if ($data) {
            $checkExists = Mst_Patient_Membership_Booking::where('membership_package_id', $data->package_id)
                ->where('membership_expiry_date', '>=', Carbon::now())
                ->where('created_at', '>=', $data->created_at)
                ->get();

            if ($checkExists->isEmpty()) {
                // No matching records found, safe to delete
                $membership = Mst_Membership_Benefit::where('membership_benefits_id', $id)->delete();
                return 1;
                // return redirect()->route('membership.edit', ['id' => $data->package_id, 'active_tab' => 3])->with('success', 'Deleted successfully');
            } else {
                return 2;
                // return redirect()->route('membership.edit', ['id' => $data->package_id, 'active_tab' => 3])->with('error', 'Cannot delete this item because it is already in use by some users.');
            }
        }
        return 3;
        // return redirect()->route('membership.edit', ['id' => $data->package_id, 'active_tab' => 3])->with('success', 'Something went wrong');
    }


    public function changeStatus(Request $request, $id)
    {
        $membership = Mst_Membership_Package::findOrFail($id);
        $membership->is_active = !$membership->is_active;
        $membership->save();
        return redirect()->back()->with('success', 'Status changed successfully');
    }

    public function viewMembership($id)
    {
        if (isset($id)) {
            $pageTitle = "Membership Package Details";

            $package_details = Mst_Membership_Package::where('membership_package_id', $id)->first();

            $benefits = Mst_Membership_Benefit::where('package_id', $id)->first();

            $membership__package__wellnesses = Mst_Membership_Package_Wellness::join('mst_wellness', 'mst__membership__package__wellnesses.wellness_id', '=', 'mst_wellness.wellness_id')
                ->where('mst__membership__package__wellnesses.package_id', $id)
                ->where('mst__membership__package__wellnesses.is_active', 1)
                ->selectRaw('mst_wellness.wellness_id, mst_wellness.wellness_name, CONCAT(mst_wellness.wellness_duration, " minutes") as wellness_duration, mst__membership__package__wellnesses.maximum_usage_limit, mst_wellness.wellness_inclusions')
                ->get();

            return view('membership.view', compact('pageTitle', 'package_details', 'benefits', 'membership__package__wellnesses'));
        }
    }
}

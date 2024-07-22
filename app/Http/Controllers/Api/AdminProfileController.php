<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mst_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminProfileController extends Controller
{
    public function getAdminDetails()
    {
        $data=array();
        try
        {
            $admin=Mst_User::find(Auth::id())->first();
            $data['status']=1;
            $data['data']=$admin;
            $data['message']="User Data Fetched";
            return response($data);

        }
        catch (\Exception $e) {
            $response = ['status' => '0', 'message' => $e->getMessage()];
            return response($response);
            
        } catch (\Throwable $e) {
                $response = ['status' => '0', 'message' => $e->getMessage()];
                return response($response);
            }


    }
    public function updatePassword(Request $request)
    {
        $data = array();

        try {
           
            
                $validator = Validator::make(
                    $request->all(),
                    [
                        'old_password'          => 'required',
                        'password' => 'required|min:6|confirmed',

                    ],
                    [
                        'old_password.required'        => 'Old password required',
                        'password.required'        => 'Password required',
                        'password.confirmed'        => 'Passwords not matching',
                    ]
                );

                if (!$validator->fails()) {

                    $user = Mst_User::find(Auth::id());

                    if (Hash::check($request->old_password, $user->password)) {
                        $data20 = [
                            'password'      => Hash::make($request->password),
                        ];
                        Mst_User::where('user_id',Auth::id())->update($data20);

                       
                        $data['status'] = 1;
                        $data['message'] = "Password updated successfully.";
                        return response($data);
                    } else {
                       
                        $data['status'] = 0;
                        $data['message'] = "Old password incorrect.";
                        return response($data);
                    }
                } else {
                    $data['status'] = 0;
                    $data['errors'] = $validator->errors();
                    $data['message'] = "failed";
                    return response($data);
                    
                }
           
        } catch (\Exception $e) {
            $response = ['status' => '0', 'message' => $e->getMessage()];
            return response($response);
        } catch (\Throwable $e) {
            $response = ['status' => '0', 'message' => $e->getMessage()];
            return response($response);
        }
    }
    public function updateProfile(Request $request)
    {
        $data=array();
        try{
        $validator = Validator::make(
            $request->all(),
            [
                'email'          => 'required|email',
                'date_of_birth' => 'required|date',
                'address'=>'required',
                'blood_group_id'=>'required',
                'gender_id'=>'required',
                'address'=>'required',
                'phone_number'=>'required',
                'profile_image'=>'sometimes|required|max:50'


            ],
            [
                'blood_group_id.required'=>'Blood Group is required',
                'gender_id.required'=>'Gender is required',
                'profile_image.max'=>'Profile imag should not be exceeded 50KB'

            ]
        );
        $validator->sometimes('profile_image', 'required', function ($request) {
            return isset($request->profile_image);
        });
        if (!$validator->fails()) {
            $user=User::find(Auth::id());
            $user->email=$request->email;
            $user->date_of_birth=$request->date_of_birth;
            $user->blood_group=$request->blood_group_id;
            $user->phone_number=$request->phone_number;
            $user->address=$request->address;
            $user->gender=$request->gender_id;
            if ($request->hasFile('profile_image')) {

                $filePro = $request->file('profile_image');
                $filenamePro = $filePro->getClientOriginalName();
                $filePro->move('assets/uploads/admin_profile/images', $filenamePro);
                $user->profile_image=$filenamePro;
            }
            $user->update();
            $data['status']=1;
            $data['user']=$user;
            $data['image_path']='assets/uploads/admin_profile/images';
            $data['message'] = "Profile updated successfully.";
            return response($data);

        }
        else
        {
            $data['status'] = 0;
            $data['errors'] = $validator->errors();
            $data['message'] = "failed";
            return response($data);

        }
    }
    catch (\Exception $e) {
            $response = ['status' => '0', 'message' => $e->getMessage()];
            return response($response);
        } catch (\Throwable $e) {
            $response = ['status' => '0', 'message' => $e->getMessage()];
            return response($response);
        }
        

    }
}

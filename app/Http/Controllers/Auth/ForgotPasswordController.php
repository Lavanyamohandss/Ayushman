<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('auth.login');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:mst_users'
        ],[
            'email.exists' => 'Email does not exist !!'
        ]);

        $status = Password::sendResetLink($request->only('email'));
        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->route('mst_login');
        } else {
            dd( __($status));
            return back()->withErrors(['error' =>  __($status),]);
        }
    }

    public function showResetPasswordForm(Request $request)
    {
        return view('auth.reset_password', [
            'email' => $request->email,
            'token' => $request->token
        ]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        echo "hi";die();
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('mst_login');
        } else {
            return back()->withErrors([
                'error' => 'Something went wrong, Please try again later',
            ]);
        }
    }
}
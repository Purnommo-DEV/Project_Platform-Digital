<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Front_ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('Front.forgot.forgot_password');
    }


    public function submitForgetPasswordForm(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        Mail::send('Front.forgot.email_forgot_password', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('message', 'We have e-mailed your password reset link!');
    }


    public function showResetPasswordForm($token)
    {
        return view('Front.forgot.forgot_password_link', ['token' => $token]);
    }


    public function submitResetPasswordForm(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'konfirmasi_password' => 'required'
        ], [
            'email.required' => 'Wajib diisi',
            'password.required' => 'Wajib diisi',
            'password.confirmed' => 'confirmed',
            'konfirmasi_password.required' => 'Wajib diisi'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }
        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email' => $request->email])->delete();
        return redirect()->route('Login')->with('message', 'Your password has been changed!');
    }
}

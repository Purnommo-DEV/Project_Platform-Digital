<?php

namespace App\Http\Controllers\Front;

use App\Models\LKP;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Entrepreneur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Front_RegisterController extends Controller
{
    public function register()
    {
        $lkp = LKP::get(['id', 'lkp']);
        return view('Front.register.register', compact('lkp'));
    }

    public function proses_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'lkp_id' => 'required'
        ], [
            'name.required' => 'Nama Wajib diisi',
            'email.required' => 'Email Wajib diisi',
            'email.email' => 'Masukkan Email dengan benar',
            'email.unique' => 'Email yang anda masukkan telah terdaftar',
            'password.required' => 'Password Wajib diisi',
            'password.min' => 'Minimal 8 karakter',
            'lkp_id.required' => 'Lembaga Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $user_register = User::create([
                'kode' => 'USER-' . $this->generateUniqueCode(),
                'email' => $request->email,
                'name' => help_hapus_spesial_karakter($request->name),
                'password' => Hash::make($request->password),
                'role_id' => 3
            ]);

            Entrepreneur::create([
                'users_id' => $user_register->id,
                'lkp_id' => $request->lkp_id,
                'slug' => Str::slug($request->name),
                'status_akun_id' => 2,
            ]);

            return response()->json([
                'status_berhasil_daftar' => 1,
                'msg' => 'Berhasil Melakukan Registrasi',
                'route' => route('Login')
            ]);
        }
    }

    public function generateUniqueCode()
    {
        do {
            $referal_code = random_int(1000000000, 9999999999);
        } while (User::where("kode", "=", $referal_code)->first());

        return $referal_code;
    }
}

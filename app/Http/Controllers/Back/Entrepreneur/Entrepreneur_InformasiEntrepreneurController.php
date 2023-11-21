<?php

namespace App\Http\Controllers\Back\Entrepreneur;

use App\Models\LKP;
use App\Models\Kota;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Entrepreneur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Entrepreneur_InformasiEntrepreneurController extends Controller
{
    public function informasi_pengguna_entrepreneur()
    {
        $kota = Kota::get();
        $lembaga = LKP::get();
        $informasi_pengguna = Entrepreneur::where('users_id', Auth::user()->id)->with('relasi_user')->first();
        return view('Back.Entrepreneur.informasi.informasi_pengguna', compact('informasi_pengguna', 'kota', 'lembaga'));
    }

    public function edit_data_informasi_pengguna_entrepreneur(Request $request, $users_id)
    {
        // dd($request->input('name'));
        if ($request->email == Auth::user()->email) {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' =>  'required',
                    'lkp_id' => 'required',
                    'kota_id' => 'required',
                    'deskripsi' => 'required',
                    'kategori' => 'required'
                ],
                [
                    'name.required' => 'Wajib diisi',
                    'email.required' => 'Wajib diisi',
                    'lkp_id.required' => 'Wajib diisi',
                    'kota_id.required' => 'Wajib diisi',
                    'deskripsi.required' => 'Wajib diisi',
                    'kategori.required' => 'Wajib diisi'
                ]
            );
        } else {
            $validator = Validator::make(
                $request->all(),
                [
                    // 'name' => 'required|regex:/[@$!%*#?&]/',
                    'name' => 'required',
                    'email' =>  ['required', Rule::unique('users')->ignore($users_id)],
                    'lkp_id' => 'required',
                    'kota_id' => 'required',
                    'deskripsi' => 'required',
                    'kategori' => 'required'
                ],
                [
                    'name.required' => 'Wajib diisi',
                    'email.required' => 'Wajib diisi',
                    'lkp_id.required' => 'Wajib diisi',
                    'kota_id.required' => 'Wajib diisi',
                    'deskripsi.required' => 'Wajib diisi',
                    'kategori.required' => 'Wajib diisi'
                ]
            );
        }

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_pengguna = User::where('id', Auth::user()->id)->first();
            $data_entrepreneur = Entrepreneur::where('users_id', $data_pengguna->id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_entrepreneur', 'public');
                $posisi_file = 'storage/' . $data_entrepreneur->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            } else {
                $path = $data_entrepreneur->path;
            }
            $data_pengguna->update([
                'name' => help_hapus_spesial_karakter($request->name),
                'email' => $request->email,
            ]);

            $data_entrepreneur->update([
                'lkp_id' => $request->lkp_id,
                'slug' => Str::slug($request->name),
                'kategori' => help_hapus_spesial_karakter($request->kategori),
                'kota_id' => $request->kota_id,
                'deskripsi' => help_hapus_spesial_karakter($request->deskripsi),
                'path' =>  $path
            ]);

            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil Mengubah Data'
            ]);
        }
    }

    public function edit_password_pengguna_entrepreneur(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'passwordlama' => [
                    'required', function ($attribute, $value, $fail) {
                        if (!Hash::check($value, Auth::user()->password)) {
                            return $fail(__('Password anda tidak cocok'));
                        }
                    },
                    'min:3', 'max:30',
                ],
                'password' => 'required|min:8|max:30',
                'konfirmasipasswordbaru' => 'required|same:password'
            ],
            [
                'passwordlama.required' => 'Wajib diisi', // custom message
                'passwordlama.min' => 'Minimal 8 Karakter', // custom message
                'passwordlama.max' => 'Maksimal 30 Karakter', // custom message

                'password.required' => 'Wajib diisi', // custom message
                'password.min' => 'Minimal 8 Karakter', // custom message
                'password.max' => 'Maksimal 30 Karakter', // custom message

                'konfirmasipasswordbaru.required' => 'Wajib diisi', // custom message
                'konfirmasipasswordbaru.same' => 'Konfirmasi password tidak tepat' // custom message

            ]
        );

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $updated = User::find(Auth::user()->id)
                ->update([
                    'password' => Hash::make($request->password)
                ]);

            if (!$updated) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal mengupdate password'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil mengupdate password'
                ]);
            }
        }
    }
}

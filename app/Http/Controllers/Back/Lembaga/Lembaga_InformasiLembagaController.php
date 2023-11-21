<?php

namespace App\Http\Controllers\Back\Lembaga;

use App\Models\LKP;
use App\Models\Kota;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\LKP_Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Lembaga_InformasiLembagaController extends Controller
{
    public function informasi_pengguna()
    {
        $kota = Kota::get();
        $kategori = LKP_Kategori::get();
        $informasi_pengguna = LKP::where('users_id', Auth::user()->id)->with('relasi_user')->first();
        return view('Back.Lembaga.informasi.informasi_pengguna', compact('informasi_pengguna', 'kategori', 'kota'));
    }

    public function edit_data_informasi_pengguna(Request $request)
    {
        if ($request->email == Auth::user()->email) {
            $validator = Validator::make($request->all(), [
                'lkp' => 'required',
                'email' => 'required',
                'kota_id' => 'required|numeric|min:1',
                'deskripsi' => 'required',
                'path' => 'mimes:jpeg,png,jpg',
            ], [
                'lkp.required' => 'Wajib diisi',
                'email.required' => 'Wajib diisi',
                'kota_id.required' => 'Wajib diisi',
                'kota_id.numeric' => 'wajib berisi angka',
                'deskripsi.required' => 'Wajib diisi',
                'path.mimes' => 'Gambar wajib berformat jpeg, png, jpg',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'lkp' => 'required',
                'email' =>  ['required', Rule::unique('users')],
                'kota_id' => 'required|numeric|min:1',
                'deskripsi' => 'required',
                'path' => 'mimes:jpeg,png,jpg',
            ], [
                'lkp.required' => 'Wajib diisi',
                'email.required' => 'Wajib diisi',
                'kota_id.required' => 'Wajib diisi',
                'kota_id.numeric' => 'wajib berisi angka',
                'deskripsi.required' => 'Wajib diisi',
                'path.mimes' => 'Gambar wajib berformat jpeg, png, jpg',
            ]);
        }


        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_pengguna = User::where('id', Auth::user()->id)->first();
            $data_lkp = LKP::where('users_id', $data_pengguna->id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_lkp', 'public');
                $posisi_file = 'storage/' . $data_lkp->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            } else {
                $path = $data_lkp->path;
            }
            $ubah_data_pengguna = $data_pengguna->update([
                'email' => $request->email,
            ]);

            $ubah_data_lkp = $data_lkp->update([
                'lkp' => help_hapus_spesial_karakter($request->lkp),
                'slug' => Str::slug($request->lkp),
                'kota_id' => $request->kota_id,
                'deskripsi' => help_hapus_spesial_karakter($request->deskripsi),
                'path' =>  $path
            ]);

            if (!$ubah_data_pengguna || !$ubah_data_lkp) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Data'
                ]);
            } else {
                return response()->json([
                    'status_berhasil' => 1,
                    'msg' => 'Berhasil Mengubah Data'
                ]);
            }
        }
    }

    public function edit_password(Request $request)
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

<?php

namespace App\Http\Controllers\Back\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Entrepreneur;
use App\Models\LKP;
use App\Models\LKP_Kategori;
use App\Models\StatusTransaksi;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Admin_PenggunaController extends Controller
{
    public function pengguna()
    {
        $kategori = LKP_Kategori::get();
        return view('Back.Admin.pengguna.pengguna', compact('kategori'));
    }

    public function data_pengguna(Request $request)
    {
        $data = LKP::select([
            'lkp.*'
        ])->with('relasi_user', 'relasi_entrepreneur')->where('role_id', 2)->orderBy('created_at', 'desc');

        // dd(count($data->relasi_entrepreneur));

        if ($request->input('search.value') != null) {
            // $data = $data->where(function ($q) use ($request) {
            //     $q->whereRaw('LOWER(email) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
            // });
            $data = $data->with('relasi_lkp')->whereHas('relasi_lkp', function ($q) use ($request) {
                $q->whereRaw('LOWER(lkp) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
            });
        }

        $rekamFilter = $data->get()->count();
        if ($request->input('length') != -1)
            $data = $data->skip($request->input('start'))->take($request->input('length'));
        $rekamTotal = $data->count();
        $data = $data->get();
        return response()->json([
            'draw' => $request->input('draw'),
            'data' => $data,
            'recordsTotal' => $rekamTotal,
            'recordsFiltered' => $rekamFilter
        ]);
    }

    public function tambah_data_pengguna(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lkp' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ], [
            'lkp.required' => 'Wajib diisi',
            'email.email' => 'Isi dengan email yang benar',
            'email.required' => 'Wajib diisi',
            'email.unique' => 'Email telah terdaftar',
            'password.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_pengguna = User::create([
                'kode' => 'USER-' . $this->generateUniqueCode(),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 2
            ]);

            LKP::create([
                'users_id' => $tambah_pengguna->id,
                'lkp' => help_hapus_spesial_karakter($request->lkp),
                'slug' => Str::slug($request->lkp)
            ]);
            return response()->json([
                'status_berhasil' => 1,
                'msg' => 'Berhasil Menambahkan Data'
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

    public function edit_data_pengguna(Request $request)
    {
        $data_pengguna = User::where('id', $request->id)->first();
        if ($request->email == $data_pengguna->email) {
            $validator = Validator::make($request->all(), [
                'lkp' => 'required',
                'email' => 'required',
            ], [
                'lkp.required' => 'Wajib diisi',
                'email.email' => 'Isi dengan email yang benar',
                'email.required' => 'Wajib diisi',
                'email.unique' => 'Email telah terdaftar'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'lkp' => 'required',
                'email' => 'required|email|unique:users',
            ], [
                'lkp.required' => 'Wajib diisi',
                'email.email' => 'Isi dengan email yang benar',
                'email.required' => 'Wajib diisi',
                'email.unique' => 'Email telah terdaftar'
            ]);
        }
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_lkp = LKP::where('users_id', $data_pengguna->id)->first();
            $data_pengguna->update([
                'email' => $request->email,
            ]);

            $data_lkp->update([
                'lkp' => help_hapus_spesial_karakter($request->lkp),
                'slug' => Str::slug($request->lkp)
            ]);

            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Mengubah Data'
            ]);
        }
    }

    public function hapus_data_pengguna($users_id)
    {
        $hapus_pengguna = User::find($users_id);
        $hapus_pengguna->delete();
        return response()->json([
            'status' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }

    public function detail_pengguna($slug)
    {
        $data_lkp = LKP::with('relasi_user', 'relasi_kota')->where('slug', $slug)->first();
        $status_transaksi = StatusTransaksi::get();
        return view('Back.Admin.pengguna.detail_pengguna', compact('data_lkp', 'status_transaksi'));
    }

    public function data_pengguna_entrepreneur(Request $request, $lkp_id)
    {
        $data = Entrepreneur::select([
            'entrepreneur.*'
        ])->with('relasi_user', 'relasi_status_akun', 'relasi_user.relasi_transaksi')->where('lkp_id', $lkp_id)->orderBy('created_at', 'desc');

        if ($request->input('search.value') != null) {
            $data = $data->with('relasi_user')->whereHas('relasi_user', function ($q) use ($request) {
                $q->whereRaw('LOWER(name) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
            });
        }

        $rekamFilter = $data->get()->count();
        if ($request->input('length') != -1)
            $data = $data->skip($request->input('start'))->take($request->input('length'));
        $rekamTotal = $data->count();
        $data = $data->get();
        return response()->json([
            'draw' => $request->input('draw'),
            'data' => $data,
            'recordsTotal' => $rekamTotal,
            'recordsFiltered' => $rekamFilter
        ]);
    }

    public function nonaktifkan_akun($id)
    {
        $data_pengguna = Entrepreneur::where('id', $id)->first();
        $data_pengguna->update([
            'status_akun_id' => 2
        ]);
        return response()->json([
            'status_berhasil' => 1,
            'msg' => 'Berhasil Menonaktifkan Akun'
        ]);
    }

    public function aktifkan_akun($id)
    {
        $data_pengguna = Entrepreneur::where('id', $id)->first();
        $data_pengguna->update([
            'status_akun_id' => 1
        ]);
        return response()->json([
            'status_berhasil' => 1,
            'msg' => 'Berhasil Aktifkan Akun'
        ]);
    }
}

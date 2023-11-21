<?php

namespace App\Http\Controllers\Back\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Admin_LembagaController extends Controller
{
    public function lembaga()
    {
        return view('Back.Admin.lembaga.lembaga');
    }

    public function data_lembaga(Request $request)
    {
        $data = User::select([
            'users.*'
        ])->where('role_id', 2)->orderBy('created_at', 'desc');

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

    public function tambah_data_lembaga(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ], [
            'name.required' => 'Wajib diisi',
            'email.required' => 'Wajib diisi',
            'password.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_lembaga = User::create([
                'kode' => 'LB-' . $this->generateUniqueCode(),
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 2
            ]);

            if (!$tambah_lembaga) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambahkan Data'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Data'
                ]);
            }
        }
    }

    public function generateUniqueCode()
    {
        do {
            $referal_code = random_int(1000000000, 9999999999);
        } while (User::where("kode", "=", $referal_code)->first());

        return $referal_code;
    }

    public function edit_data_lembaga(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required'
        ], [
            'name.required' => 'Wajib diisi',
            'email.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_lembaga = User::where('id', $request->id)->first();
            $ubah_data_lembaga = $data_lembaga->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'email' => $request->email,
            ]);

            if (!$ubah_data_lembaga) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Data'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Mengubah Data'
                ]);
            }
        }
    }

    public function hapus_data_lembaga($lembaga_id)
    {
        $hapus_lembaga = User::find($lembaga_id);
        $hapus_lembaga->delete();
        return response()->json([
            'status' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }
}

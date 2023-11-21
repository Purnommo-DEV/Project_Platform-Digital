<?php

namespace App\Http\Controllers\Back\Admin;

use App\Models\LKP_Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Admin_KategoriController extends Controller
{
    public function kategori()
    {
        return view('Back.Admin.kategori.kategori');
    }

    public function data_kategori(Request $request)
    {
        $data = LKP_Kategori::select([
            'kategori.*'
        ]);

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

    public function tambah_data_kategori(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required',
        ], [
            'kategori.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_kategori = LKP_Kategori::create([
                'kategori' => $request->kategori,
            ]);

            if (!$tambah_kategori) {
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
        } while (LKP_Kategori::where("kode", "=", $referal_code)->first());

        return $referal_code;
    }

    public function edit_data_kategori(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required'
        ], [
            'kategori.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_kategori = LKP_Kategori::where('id', $request->id)->first();
            $ubah_data_kategori = $data_kategori->update([
                'kategori' => $request->kategori
            ]);

            if (!$ubah_data_kategori) {
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

    public function hapus_data_kategori($kategori_id)
    {
        $hapus_kategori = LKP_Kategori::find($kategori_id);
        $hapus_kategori->delete();
        return response()->json([
            'status' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }
}

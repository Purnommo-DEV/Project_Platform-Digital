<?php

namespace App\Http\Controllers\Back\Admin;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Entrepreneur;
use App\Models\StatusTransaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Admin_TransaksiController extends Controller
{
    public function transaksi()
    {
        $status_transaksi = StatusTransaksi::select(['id', 'status'])->get();
        $data_pengguna = User::where('role_id', 2)->get();
        return view('Back.Admin.transaksi.transaksi', compact('data_pengguna', 'status_transaksi'));
    }

    public function tampil_data_pengguna_dari_kode(Request $request)
    {
        $data_pengguna = User::select(['id', 'name', 'email', 'kode'])->where('id', $request->pengguna_id)->first();
        return response()->json([
            'data_pengguna' => $data_pengguna
        ]);
    }

    public function data_transaksi(Request $request)
    {
        $data = Transaksi::select([
            'transaksi.*'
        ])->with('relasi_user', 'relasi_status_transaksi')->orderBy('created_at', 'desc');

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

    public function tambah_data_transaksi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => 'required',
            'path' => 'required',
            'total_bayar' => 'required',
            'status_id' => 'required'
        ], [
            'users_id.required' => 'Wajib diisi',
            'path.required' => 'Wajib diisi',
            'total_bayar.required' => 'Wajib diisi',
            'status_id.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_transaksi', 'public');
            }
            $total_bayar = str_replace(['Rp. ', '.', '.'], ['', '', ''], $request->total_bayar);
            $data_transaksi = Transaksi::where('users_id', $request->users_id)->count();
            if ($data_transaksi == null) {
                Transaksi::create([
                    'kode' => 'TR-' . $this->generateUniqueCode(),
                    'users_id' => $request->users_id,
                    'status_id' => $request->status_id,
                    'total_bayar' => $total_bayar,
                    'catatan' => $request->catatan,
                    'path' => $path
                ]);
                return response()->json([
                    'status_berhasil' => 1,
                    'msg' => 'Berhasil Menambahkan Data'
                ]);
            } else {
                return response()->json([
                    'status_sudah_transaksi' => 1,
                    'msg' => 'Terjadi kesalahan, Data ini telah ada di daftar transaksi'
                ]);
            }
        }
    }

    public function generateUniqueCode()
    {
        do {
            $referal_code = random_int(1000000000, 9999999999);
        } while (Transaksi::where("kode", "=", $referal_code)->first());

        return $referal_code;
    }

    public function pembayaran_pengguna(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'total_bayar' => 'required',
            'status_id' => 'required',
            'path' => 'required'
        ], [
            'total_bayar.required' => 'Wajib diisi',
            'status_id.required' => 'Wajib diisi',
            'path.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_entrepreneur = Entrepreneur::where('id', $request->id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_transaksi', 'public');
            }
            $data_entrepreneur->update([
                'status_akun_id' => 1,
                'tanggal_berakhir' => Carbon::now()->addYear(1)
            ]);
            $total_bayar = str_replace(['Rp. ', '.', '.'], ['', '', ''], $request->total_bayar);
            $tambah_data_transaksi = Transaksi::create([
                'kode' => 'TR-' . $this->generateUniqueCode(),
                'users_id' => $data_entrepreneur->users_id,
                'status_id' => $request->status_id,
                'total_bayar' => $total_bayar,
                'catatan' => $request->catatan,
                'path' => $path,
                'status_akun_id' => 1
            ]);

            if (!$tambah_data_transaksi) {
                return response()->json([
                    'status_gagal' => 1,
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

    public function hapus_data_transaksi($transaksi_id)
    {
        $hapus_transaksi = Transaksi::find($transaksi_id);
        $path = 'storage/' . $hapus_transaksi->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_transaksi->delete();
        return response()->json([
            'status' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }
}

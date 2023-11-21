<?php

namespace App\Http\Controllers\Back\Entrepreneur;

use App\Models\Entrepreneur;
use Illuminate\Http\Request;
use App\Models\PenggunaProduk;
use App\Models\PenggunaSosmed;
use App\Http\Controllers\Controller;
use App\Models\LKP;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Entrepreneur_EntrepreneurController extends Controller
{
    // PENGGUNA SOSIAL MEDIA
    public function sosmed_pengguna()
    {
        $data_pengguna = Entrepreneur::where('users_id', Auth::user()->id)->first();
        return view('Back.Entrepreneur.entrepreneur.pengguna_sosmed', compact('data_pengguna'));
    }

    public function data_sosmed_pengguna(Request $request)
    {
        $data = PenggunaSosmed::select([
            'pengguna_sosmed.*'
        ])->where('users_id', Auth::user()->id)->orderBy('created_at', 'desc');

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

    public function tambah_data_sosmed_pengguna(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'link' => ['required', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'sosmed' => 'required'
        ], [
            'link.required' => 'Wajib diisi',
            'link.regex' => 'Tidak sesuai format URL',
            'sosmed.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_lkp_sosmed = PenggunaSosmed::create([
                'users_id' => Auth::user()->id,
                'link' => $request->link,
                'sosmed' => $request->sosmed
            ]);

            if (!$tambah_lkp_sosmed) {
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

    public function hapus_data_sosmed_pengguna($sosmed_id)
    {
        $hapus_lkp_sosmed = PenggunaSosmed::find($sosmed_id);
        $hapus_lkp_sosmed->delete();
        return response()->json([
            'status' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }


    // GAMBAR PRODUK PENGGUNA
    public function produk_pengguna()
    {
        return view('Back.Entrepreneur.entrepreneur.pengguna_produk');
    }

    public function data_produk_pengguna(Request $request)
    {
        $data = PenggunaProduk::select([
            'pengguna_produk.*'
        ])->where('users_id', Auth::user()->id)->orderBy('created_at', 'desc');

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
    public function tambah_data_gambar_produk_pengguna(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'path' => 'required',
            'nama_gambar' => 'required'
        ], [
            'path.required' => 'Wajib diisi',
            'nama_gambar.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $files = $request->file('path');
            // foreach ($files as $file_gambar) {
            $tambah_gambar_produk = PenggunaProduk::create([
                'users_id' => Auth::user()->id,
                'lkp_id' => Auth::user()->relasi_entrepreneur->lkp_id,
                'nama_gambar' => help_hapus_spesial_karakter($request->nama_gambar),
                'path' => $files->store('pengguna_gambar_produk', 'public')
            ]);
            // }

            if (!$tambah_gambar_produk) {
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

    public function edit_data_gambar_produk_pengguna(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_gambar' => 'required'
        ], [
            'nama_gambar.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_gambar_produk = PenggunaProduk::where('id', $request->id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('pengguna_gambar_produk', 'public');
                $posisi_file = 'storage/' . $data_gambar_produk->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            } else {
                $path = $data_gambar_produk->path;
            }
            $ubah_data_gambar_produk = $data_gambar_produk->update([
                'nama_gambar' => help_hapus_spesial_karakter($request->nama_gambar),
                'path' => $path
            ]);

            if (!$ubah_data_gambar_produk) {
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

    public function hapus_data_gambar_produk_pengguna($gambar_produk_id)
    {
        $hapus_lkp_gambar_produk = PenggunaProduk::find($gambar_produk_id);
        $path = 'storage/' . $hapus_lkp_gambar_produk->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_lkp_gambar_produk->delete();
        return response()->json([
            'status' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }

    public function billing_pengguna()
    {
        $data_pengguna = User::with('relasi_entrepreneur.relasi_status_akun', 'relasi_entrepreneur', 'relasi_transaksi')->where('id', Auth::user()->id)->first();
        return view('Back.Entrepreneur.entrepreneur.pengguna_billing', compact('data_pengguna'));
    }
}

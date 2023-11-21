<?php

namespace App\Http\Controllers\Back\Lembaga;

use App\Models\LKP;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LKP_GambarProduk;
use App\Models\LKP_Iklan;
use App\Models\LKP_Kategori;
use App\Models\LKP_Sosmed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class Lembaga_LKPController extends Controller
{
    public function lkp()
    {
        $kategori = LKP_Kategori::get();
        return view('Back.Lembaga.lkp.lkp', compact('kategori'));
    }

    public function data_lkp(Request $request)
    {
        $data = LKP::select([
            'lkp.*'
        ])->with('relasi_kategori')->where('users_id', Auth::user()->id)->orderBy('created_at', 'desc');

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

    public function tambah_data_lkp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lkp' => 'required',
            'kategori_id' => 'required',
            'path' => 'required'
        ], [
            'lkp.required' => 'Wajib diisi',
            'kategori_id.required' => 'Wajib diisi',
            'path.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_lkp', 'public');
            }
            $tambah_lkp = LKP::create([
                'users_id' => Auth::user()->id,
                'lkp' => $request->lkp,
                'slug' => Str::slug($request->lkp),
                'kategori_id' => $request->kategori_id,
                'deskripsi' => $request->deskripsi,
                'path' => $path,
            ]);

            if (!$tambah_lkp) {
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

    public function edit_data_lkp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lkp' => 'required',
            'kategori_id' => 'required'
        ], [
            'lkp.required' => 'Wajib diisi',
            'kategori_id.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_lkp = LKP::where('id', $request->id)->first();
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_lkp', 'public');
                $posisi_file = 'storage/' .  $data_lkp->path;
                if (File::exists($posisi_file)) {
                    File::delete($posisi_file);
                }
            } else {
                $path =  $data_lkp->path;
            }
            $ubah_data_lkp = $data_lkp->update([
                'lkp' => $request->lkp,
                'slug' => Str::slug($request->lkp),
                'kategori_id' => $request->kategori_id,
                'deskripsi' => $request->deskripsi,
                'path' => $path,
            ]);

            if (!$ubah_data_lkp) {
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

    public function hapus_data_lkp($lkp_id)
    {
        $hapus_lkp = LKP::find($lkp_id);
        $path = 'storage/' . $hapus_lkp->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_lkp->delete();
        return response()->json([
            'status' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }

    public function detail_lkp($slug)
    {
        $data_lkp = LKP::where('slug', $slug)->first();
        $data_lkp_gambar_produk = LKP_GambarProduk::where('lkp_id', $data_lkp->id)->get();
        return view('Back.Lembaga.lkp.detail_lkp', compact('data_lkp', 'data_lkp_gambar_produk'));
    }

    // LKP SOSIAL MEDIA
    public function sosmed()
    {
        $data_lkp = LKP::where('users_id', Auth::user()->id)->first();
        return view('Back.Lembaga.lkp.sosmed', compact('data_lkp'));
    }

    public function data_lkp_sosmed(Request $request, $lkp_id)
    {
        $data = LKP_Sosmed::select([
            'lkp_sosmed.*'
        ])->where('lkp_id', $lkp_id)->orderBy('created_at', 'desc');

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

    public function tambah_data_lkp_sosmed(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'link_sosmed' => ['required', 'regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            'sosmed' => 'required'
        ], [
            'link_sosmed.required' => 'Wajib diisi',
            'link_sosmed.regex' => 'Tidak sesuai format URL',
            'sosmed.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status_form_kosong' => 1,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_lkp_sosmed = LKP_Sosmed::create([
                'lkp_id' => Auth::user()->relasi_lkp->id,
                'link_sosmed' => $request->link_sosmed,
                'sosmed' => $request->sosmed
            ]);

            if (!$tambah_lkp_sosmed) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambahkan Data'
                ]);
            } else {
                return response()->json([
                    'status_berhasil' => 1,
                    'msg' => 'Berhasil Menambahkan Data'
                ]);
            }
        }
    }

    public function hapus_data_lkp_sosmed($sosmed_id)
    {
        $hapus_lkp_sosmed = LKP_Sosmed::find($sosmed_id);
        $hapus_lkp_sosmed->delete();
        return response()->json([
            'status' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }

    // LKP IKLAN
    public function promosi()
    {
        $data_lkp = LKP::where('users_id', Auth::user()->id)->first();
        return view('Back.Lembaga.lkp.promosi', compact('data_lkp'));
    }

    public function data_lkp_iklan(Request $request, $lkp_id)
    {
        $data = LKP_Iklan::select([
            'lkp_iklan.*'
        ])->where('lkp_id', $lkp_id)->orderBy('created_at', 'desc');

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

    public function tambah_data_lkp_iklan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'path' => 'required'
        ], [
            'path.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if ($request->hasFile('path')) {
                $filenameWithExt = $request->file('path')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('path')->getClientOriginalExtension();
                $filenameSimpan = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('path')->store('gambar_lkp_iklan', 'public');
            }
            $tambah_lkp_iklan = LKP_Iklan::create([
                'lkp_id' => Auth::user()->relasi_lkp->id,
                'path' => $path,
            ]);

            if (!$tambah_lkp_iklan) {
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

    public function hapus_data_lkp_iklan($iklan_id)
    {
        $hapus_lkp_iklan = LKP_Iklan::find($iklan_id);
        $path = 'storage/' . $hapus_lkp_iklan->path;
        if (File::exists($path)) {
            File::delete($path);
        }
        $hapus_lkp_iklan->delete();
        return response()->json([
            'status' => 1,
            'msg'   => 'Berhasil Menghapus Data',
        ]);
    }

    // LKP GAMBAR PRODUK
    public function produk()
    {
        $data_lkp = LKP::where('users_id', Auth::user()->id)->first();
        $data_lkp_gambar_produk = LKP_GambarProduk::where('lkp_id', $data_lkp->id)->get();
        return view('Back.Lembaga.lkp.produk', compact('data_lkp_gambar_produk', 'data_lkp'));
    }
    public function tambah_data_lkp_gambar_produk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'path.*' => 'required',
        ], [
            'path.*.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $files = $request->file('path');
            foreach ($files as $file_gambar) {
                $tambah_gambar_produk = LKP_GambarProduk::create([
                    'lkp_id' => $request->req_lkp_id,
                    'path' => $file_gambar->store('lkp_gambar_produk', 'public')
                ]);
            }

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

    public function hapus_data_lkp_gambar_produk($gambar_produk_id)
    {
        $hapus_lkp_gambar_produk = LKP_GambarProduk::find($gambar_produk_id);
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
}

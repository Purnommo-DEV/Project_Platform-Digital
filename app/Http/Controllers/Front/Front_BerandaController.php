<?php

namespace App\Http\Controllers\Front;

use App\Models\LKP;
use App\Models\User;
use App\Models\LKP_Iklan;
use App\Models\LKP_Sosmed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Entrepreneur;
use App\Models\PenggunaProduk;
use App\Models\PenggunaSosmed;

class Front_BerandaController extends Controller
{
    public function beranda()
    {
        $lkp = LKP::with('relasi_kota')->get();
        return view('Front.beranda.beranda', compact('lkp'));
    }

    public function detail_lembaga($slug)
    {
        $lkp = LKP::with('relasi_lembaga')->whereRelation('relasi_lembaga', 'slug', $slug)->get();
        return view('Front.lembaga.detail_lembaga', compact('lkp'));
    }

    public function detail_lkp($slug)
    {
        $lkp_detail = LKP::with('relasi_kota')->where('slug', $slug)->first();
        $iklan_lkp = LKP_Iklan::where('lkp_id', $lkp_detail->id)->get();
        $sosmed_lkp = LKP_Sosmed::where('lkp_id', $lkp_detail->id)->get();
        $produk_pengguna = PenggunaProduk::where('lkp_id', $lkp_detail->id)->get();
        return view('Front.lembaga.detail_lkp', compact('lkp_detail', 'iklan_lkp', 'produk_pengguna', 'sosmed_lkp'));
    }

    public function pencarian(Request $request)
    {
        // $data = Program::select("judul as value", "id")
        // ->where('judul', 'LIKE', '%'. $request->get('search'). '%')
        // ->get();
        // return response()->json($data);

        // $data = [];
        // if($request->has('q')){
        $search = $request->get('search');
        // $data = DB::table("lkp")
        //     ->select("lkp as value", "id")
        //     ->where('lkp', 'LIKE', "%$search%")
        //     ->get();

        $data = LKP::where('lkp', 'LIKE', "%$search%")->get();

        // $data = DB::table("lkp")
        //     ->select("lkp.lkp as value", "lkp.id", "lkp.users_id", "transaksi.users_id")
        //     ->join("transaksi", "transaksi.users_id", "=", "lkp.users_id")
        //     ->where('lkp', 'LIKE', "%$search%")
        //     ->get();


        // }
        return response()->json($data);
    }

    public function hasil_pencarian(Request $request)
    {
        if ($request->mitra_id == null) {
            return response()->json([
                'status_tidak_ditemukan' => 1
            ]);
        } else {
            $data_lkp = LKP::with('relasi_kota')->where('id', $request->mitra_id)->first();

            return response()->json([
                'status_ditemukan' => 1,
                'data' => $data_lkp
            ]);
        }
    }

    public function tampil_semua_lkp(Request $request)
    {
        $lkp = LKP::get();
        if ($request->ajax()) {
            $view = view('Front.beranda.lkp', compact('lkp'))->render();

            return response()->json(['html' => $view]);
        }
    }

    public function tampil_semua_entrepreneur(Request $request)
    {
        $entrepreneur = Entrepreneur::with('relasi_user', 'relasi_kota')->get();
        if ($entrepreneur->count() == 0) {
            return response()->json(['status_data_kosong' => 1]);
        } else {
            if ($request->ajax()) {
                $view = view('Front.beranda.entrepreneur', compact('entrepreneur'))->render();
                return response()->json([
                    'status_data_ada' => 1,
                    'html' => $view
                ]);
            }
        }
    }

    public function detail_entrepreneur($slug)
    {
        $entrepreneur_detail = Entrepreneur::with('relasi_user')->where('slug', $slug)->first();
        $iklan_lkp = LKP_Iklan::where('lkp_id', $entrepreneur_detail->lkp_id)->get();
        $sosmed_pengguna = PenggunaSosmed::where('users_id', $entrepreneur_detail->users_id)->get();
        $produk_pengguna = PenggunaProduk::where('users_id', $entrepreneur_detail->users_id)->get();
        return view('Front.lembaga.detail_entrepreneur', compact('entrepreneur_detail', 'iklan_lkp', 'produk_pengguna', 'sosmed_pengguna'));
    }

    public function pdf_sk_jakilat()
    {
        return view('Front.pdf.sk_jakilat');
    }
}

<?php

namespace App\Http\Controllers\Back\Admin;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class Admin_LaporanKeuanganController extends Controller
{
    public function laporan_keuangan()
    {
        return view('Back.Admin.laporan.keuangan.keuangan');
    }

    public function data_laporan_keuangan(Request $request)
    {
        $data = Transaksi::select([
            'transaksi.*'
        ])->with('relasi_user', 'relasi_status_transaksi')->orderBy('created_at', 'desc');

        if ($request->input('req_tgl_awal') && $request->input('req_tgl_akhir')) {
            $tgl_awal = Carbon::parse($request->input('req_tgl_awal'));
            $tgl_akhir = Carbon::parse($request->input('req_tgl_akhir'));
            if ($tgl_akhir->greaterThan($tgl_awal)) {
                $data = $data->whereBetween('created_at', [$tgl_awal, $tgl_akhir]);
                $data->get();
            } else {
                $data = $data->get();
            }
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
            'recordsFiltered' => $rekamFilter,
        ]);
    }
}

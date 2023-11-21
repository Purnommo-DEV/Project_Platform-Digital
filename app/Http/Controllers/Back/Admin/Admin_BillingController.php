<?php

namespace App\Http\Controllers\Back\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class Admin_BillingController extends Controller
{
    public function billing()
    {
        return view('Back.Admin.billing.billing');
    }

    public function data_billing(Request $request)
    {
        $data = Transaksi::select([
            'transaksi.*'
        ])->with('relasi_user', 'relasi_status_transaksi', 'relasi_user.relasi_entrepreneur')->orderBy('created_at', 'desc');

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
}

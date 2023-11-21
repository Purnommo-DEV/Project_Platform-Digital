<?php

namespace App\Http\Controllers\Back\Admin;

use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Admin_DashboardController extends Controller
{
    public function dashboard()
    {
        $total_pengguna = User::where('role_id', 2)->count();
        $total_membayar = Transaksi::where('status_id', 1)->count();
        $total_pendapatan = Transaksi::where('status_id', 1)->sum('total_bayar');
        return view('Back.Admin.dashboard.dashboard', compact('total_pengguna', 'total_membayar', 'total_pendapatan'));
    }
}

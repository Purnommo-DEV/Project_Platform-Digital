<?php

use App\Http\Controllers\Back\Admin\Admin_BillingController;
use App\Http\Controllers\Back\Admin\Admin_DashboardController;
use App\Http\Controllers\Back\Admin\Admin_KategoriController;
use App\Http\Controllers\Back\Admin\Admin_LaporanKeuanganController;
use App\Http\Controllers\Back\Admin\Admin_PenggunaController;
use App\Http\Controllers\Back\Admin\Admin_SliderController;
use App\Http\Controllers\Back\Admin\Admin_TransaksiController;
use App\Http\Controllers\Back\Entrepreneur\Entrepreneur_EntrepreneurController;
use App\Http\Controllers\Back\Entrepreneur\Entrepreneur_InformasiEntrepreneurController;
use App\Http\Controllers\Back\Lembaga\Lembaga_InformasiLembagaController;
use App\Http\Controllers\Back\Lembaga\Lembaga_LKPController;
use App\Http\Controllers\Front\Front_BerandaController;
use App\Http\Controllers\Front\Front_ForgotPasswordController;
use App\Http\Controllers\Front\Front_RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['xss']], function () {
    Route::get('/', [Front_BerandaController::class, 'beranda'])->name('HalamanBeranda');
    Route::get('/detail-lembaga/{slug}', [Front_BerandaController::class, 'detail_lembaga'])->name('HalamanDetailLembaga');
    Route::get('/detail-lkp/{slug}', [Front_BerandaController::class, 'detail_lkp'])->name('HalamanDetailLKP');
    Route::get('/pencarian', [Front_BerandaController::class, 'pencarian'])->name('Pencarian');
    Route::post('/hasil-pencarian', [Front_BerandaController::class, 'hasil_pencarian'])->name('HasilPencarian');
    Route::get('/tampil-semua-lkp', [Front_BerandaController::class, 'tampil_semua_lkp'])->name('TampilDataSemuaLKP');
    Route::get('/tampil-semua-entrepreneur', [Front_BerandaController::class, 'tampil_semua_entrepreneur'])->name('TampilDataSemuaEntrepreneur');

    Route::get('/detail-entrepreneur/{slug}', [Front_BerandaController::class, 'detail_entrepreneur'])->name('HalamanDetailEntrepreneur');
    Route::get('/sk-jakilat', [Front_BerandaController::class, 'pdf_sk_jakilat'])->name('SKJakilat');

    Route::get('forget-password', [Front_ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('forget-password', [Front_ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('ForgotPasswordPost');
    Route::get('reset-password/{token}', [Front_ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [Front_ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

    Route::middleware(['guest'])->group(function () {
        // Route::controller(Front_RegisterController::class)->group(function () {
        //     Route::get('/register', 'register')->name('Register');
        //     Route::post('/pengguna-register', 'proses_register')->name('RegisterPengguna');
        // });

        Route::get('/register', [Front_RegisterController::class, 'register'])->name('Register');
        Route::post('/pengguna-register', [Front_RegisterController::class, 'proses_register'])->name('RegisterPengguna');

        Route::controller(LoginController::class)->group(function () {
            Route::get('/login', 'login')->name('Login');
            Route::post('/pengguna-login', 'autentikasi')->name('LoginPengguna');
        });
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/user-logout', [LoginController::class, 'logout'])->name('LogoutPengguna');

        Route::prefix('admin')->name('admin.')->middleware(['isAdmin'])->group(function () {
            Route::controller(Admin_DashboardController::class)->group(function () {
                Route::get('/dashboard', 'dashboard')->name('HalamanDashboard');
            });
            Route::controller(Admin_PenggunaController::class)->group(function () {
                Route::get('/pengguna', 'pengguna')->name('HalamanPengguna');
                Route::any('/data-pengguna', 'data_pengguna')->name('DataPengguna');
                Route::post('/tambah-data-pengguna', 'tambah_data_pengguna')->name('TambahDataPengguna');
                Route::post('/edit-data-pengguna', 'edit_data_pengguna')->name('EditDataPengguna');
                Route::get('/hapus-data-pengguna/{pengguna_id}', 'hapus_data_pengguna');

                Route::get('/detail-pengguna/{slug}', 'detail_pengguna')->name('HalamanPengguna.HalamanDetailPengguna');
                Route::any('/data-pengguna-entrepreneur/{lkp_id}', 'data_pengguna_entrepreneur')->name('DataPenggunaEntrepreneur');

                Route::get('/nonaktifkan-akun/{id}', 'nonaktifkan_akun');
                Route::get('/aktifkan-akun/{id}', 'aktifkan_akun');
            });

            Route::controller(Admin_KategoriController::class)->group(function () {
                Route::get('/kategori', 'kategori')->name('HalamanKategori');
                Route::any('/data-kategori', 'data_kategori')->name('DataKategori');
                Route::post('/tambah-data-kategori', 'tambah_data_kategori')->name('TambahDataKategori');
                Route::post('/edit-data-kategori', 'edit_data_kategori')->name('EditDataKategori');
                Route::get('/hapus-data-kategori/{kategori_id}', 'hapus_data_kategori');
            });

            Route::controller(Admin_TransaksiController::class)->group(function () {
                Route::get('/transaksi', 'transaksi')->name('HalamanTransaksi');
                Route::any('/data-transaksi', 'data_transaksi')->name('DataTransaksi');
                Route::post('/tambah-data-transaksi', 'tambah_data_transaksi')->name('TambahDataTransaksi');
                Route::post('/pembayaran-pengguna', 'pembayaran_pengguna')->name('PembayaranPengguna');
                Route::get('/hapus-data-transaksi/{transaksi_id}', 'hapus_data_transaksi');
                Route::get('/tampil-data-pengguna-dari-kode', 'tampil_data_pengguna_dari_kode')->name('TampilDataPenggunaDariKode');
            });

            Route::controller(Admin_SliderController::class)->group(function () {
                Route::get('/slider', 'slider')->name('HalamanSlider');
                Route::any('/data-slider', 'data_slider')->name('DataSlider');
                Route::post('/tambah-data-slider', 'tambah_data_slider')->name('TambahDataSlider');
                Route::post('/edit-data-slider', 'edit_data_slider')->name('EditDataSlider');
                Route::get('/hapus-data-slider/{slider_id}', 'hapus_data_slider');
            });

            Route::controller(Admin_BillingController::class)->group(function () {
                Route::get('/billing', 'billing')->name('HalamanBilling');
                Route::any('/data-billing', 'data_billing')->name('DataBilling');
            });

            Route::controller(Admin_LaporanKeuanganController::class)->group(function () {
                Route::get('/laporan-keuangan', 'laporan_keuangan')->name('HalamanLaporanKeuangan');
                Route::any('/data-laporan-keuangan', 'data_laporan_keuangan')->name('DataLaporanKeuangan');
            });
        });

        Route::prefix('lembaga')->name('lembaga.')->middleware(['isLembaga'])->group(function () {
            Route::controller(Lembaga_InformasiLembagaController::class)->group(function () {
                Route::get('/informasi-pengguna', 'informasi_pengguna')->name('HalamanInformasiPengguna');
                Route::post('/edit-data-informasi-pengguna', 'edit_data_informasi_pengguna')->name('EditDataInformasiPengguna');
                Route::post('/edit-password', 'edit_password')->name('EditPassword');
            });

            Route::controller(Lembaga_LKPController::class)->group(function () {
                Route::get('/sosial-media', 'sosmed')->name('HalamanSosialMediaLKP');
                Route::any('/data-lkp-sosmed/{lkp_id}', 'data_lkp_sosmed');
                Route::post('/tambah-data-lkp-sosmed', 'tambah_data_lkp_sosmed')->name('TambahDataLKPSosmed');
                Route::get('/hapus-data-lkp-sosmed/{sosmed_id}', 'hapus_data_lkp_sosmed');

                Route::get('/iklan', 'promosi')->name('HalamanPromosiLKP');
                Route::any('/data-lkp-iklan/{lkp_id}', 'data_lkp_iklan')->name('DataLKPIklan');
                Route::post('/tambah-data-lkp-iklan', 'tambah_data_lkp_iklan')->name('TambahDataLKPIklan');
                Route::get('/hapus-data-lkp-iklan/{iklan_id}', 'hapus_data_lkp_iklan');

                Route::get('/produk', 'produk')->name('HalamanProdukLKP');
                Route::post('/tambah-data-lkp-gambar-produk', 'tambah_data_lkp_gambar_produk')->name('TambahDataLKPGambarProduk');
                Route::get('/hapus-data-lkp-gambar-produk/{gambar_produk_id}', 'hapus_data_lkp_gambar_produk');
            });
        });

        Route::prefix('entrepreneur')->name('entrepreneur.')->middleware(['isEntrepreneur'])->group(function () {
            Route::controller(Entrepreneur_InformasiEntrepreneurController::class)->group(function () {
                Route::get('/informasi-pengguna-entrepreneur', 'informasi_pengguna_entrepreneur')->name('HalamanInformasiPenggunaEntrepreneur');
                Route::post('/edit-data-informasi-pengguna-entrepreneur/{users_id}', 'edit_data_informasi_pengguna_entrepreneur')->name('EditDataInformasiPenggunaEntrepreneur');
                Route::post('/edit-password-pengguna-entrepreneur', 'edit_password_pengguna_entrepreneur')->name('EditPasswordPenggunaEntrepreneur');
            });

            Route::controller(Entrepreneur_EntrepreneurController::class)->group(function () {
                Route::get('/sosial-media-pengguna', 'sosmed_pengguna')->name('HalamanSosialMediaPengguna');
                Route::any('/data-sosmed-pengguna', 'data_sosmed_pengguna')->name('DataSosmedPengguna');
                Route::post('/tambah-data-sosmed-pengguna', 'tambah_data_sosmed_pengguna')->name('TambahDataSosmedPengguna');
                Route::get('/hapus-data-sosmed-pengguna/{sosmed_id}', 'hapus_data_sosmed_pengguna');

                Route::get('/billing-pengguna', 'billing_pengguna')->name('HalamanBillingPengguna');

                Route::get('/produk-pengguna', 'produk_pengguna')->name('HalamanProdukPengguna');
                Route::any('/data-produk-pengguna', 'data_produk_pengguna')->name('DataProdukPengguna');
                Route::post('/tambah-data-gambar-produk-pengguna', 'tambah_data_gambar_produk_pengguna')->name('TambahDataGambarProdukPengguna');
                Route::post('/edit-data-gambar-produk-pengguna', 'edit_data_gambar_produk_pengguna')->name('EditDataGambarProdukPengguna');
                Route::get('/hapus-data-gambar-produk-pengguna/{gambar_produk_id}', 'hapus_data_gambar_produk_pengguna');
            });
        });
    });
});

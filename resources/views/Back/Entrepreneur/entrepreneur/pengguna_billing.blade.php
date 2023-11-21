@extends('Back.layout.master', ['title' => 'Billing Pengguna'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                    <div class="card-body">
                        <section class="py-3 py-md-5 py-xl-8">
                            <div class="container">
                                <div class="row gy-5 gy-lg-0 align-items-lg-center">
                                    <div class="col-12 col-lg-6">
                                        <img class="img-fluid rounded" loading="lazy"
                                            src="{{ asset('All/img/cara-bayar.jpg') }}"
                                            style="aspect-ratio:1/1; border-radius:1rem;">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="row justify-content-xl-end">
                                            <div class="col-12 col-xl-11">
                                                <h2 class="h1 mb-3">Cara Pembayaran</h2>
                                                <p class="lead fs-4 text-secondary mb-5">Ikuti langkah-langkah berikut untuk
                                                    mengetahui cara membayar dengan melalui transfer bank</p>
                                                <div class="d-flex mb-4">
                                                    <div>
                                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">1</span>
                                                    </div>
                                                    <div>
                                                        <h4 class="mb-3">Transfer Via Bank</h4>
                                                        <p class="mb-0 text-secondary">Transfer ke nomor rekening
                                                            1310072577259 - BANK MANDIRI - PT IDE KREATIF NUSANTARA</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex mb-4">
                                                    <div>
                                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">2</span>
                                                    </div>
                                                    <div>
                                                        <h4 class="mb-3">Kirim Bukti Pembayaran</h4>
                                                        <p class="mb-0 text-secondary">Bukti pembayaran dikirim ke nomor
                                                            berikut dengan
                                                            mencantumkan nama lembaga Anda :</h6>
                                                        <p>+628-12-5117-4782 (WhatsApp)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="informasi" role="tabpanel"
                                aria-labelledby="informasi-tab">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6>Pembayaran dilakukan melalui rekening yang tertera sebagai berikut :</h6>
                                            <p>1310072577259 - BANK MANDIRI - PT IDE KREATIF NUSANTARA</p>
                                        </div>
                                        <div class="form-group">
                                            <h6>Bukti pembayaran dikirim ke nomor berikut dengan
                                                mencantumkan nama lembaga Anda :</h6>
                                            <p>+628-12-5117-4782 (WhatsApp) </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                    <div class="card-body">
                        <table class="table table-striped" id="table-data-daftar-entrepreneur">
                            <thead>
                                <tr>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th>Status Bayar</th>
                                    <th>Bukti Bayar</th>
                                    <th>Status Akun</th>
                                    <th>Tanggal Konfirmasi Pembayaran</th>
                                    <th>Tanggal Berakhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $data_pengguna->name }}</td>
                                    <td>{{ $data_pengguna->email }}</td>
                                    <td>
                                        @if ($data_pengguna->relasi_transaksi != null)
                                            Sudah Membayar
                                        @else
                                            Belum Membayar
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data_pengguna->relasi_transaksi != null)
                                            <img src="{{ asset('storage/' . $data_pengguna->relasi_transaksi->path) }}"
                                                style="aspect-ratio:1/1; border-radius:1rem;" width="40%">
                                        @else
                                            <img src="/All/img/no_image.jpg" width="100">
                                        @endif
                                    </td>
                                    <td>{{ $data_pengguna->relasi_entrepreneur->relasi_status_akun->status }}</td>
                                    <td>
                                        @if ($data_pengguna->relasi_transaksi != null)
                                            {{ @help_tanggal_jam($data_pengguna->relasi_transaksi->created_at) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data_pengguna->relasi_entrepreneur->tanggal_berakhir != null)
                                            {{ @help_tanggal_jam($data_pengguna->relasi_entrepreneur->tanggal_berakhir) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('Back.layout.master', ['title' => 'Data Detail Pengguna'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="informasi-tab" data-bs-toggle="tab" href="#informasi"
                                    role="tab" aria-controls="informasi" aria-selected="true">Informasi</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="kata-sandi-tab" data-bs-toggle="tab" href="#kata-sandi"
                                    role="tab" aria-controls="kata-sandi" aria-selected="false">Keamanan</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="informasi" role="tabpanel"
                                aria-labelledby="informasi-tab">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h6><strong>Nama Pengguna/Lembaga</strong></strong></h6>
                                            <p>{{ $data_lkp->lkp }}</p>
                                        </div>
                                        <div class="form-group">
                                            <h6><strong>Email</strong></h6>
                                            <p>{{ $data_lkp->relasi_user->email }}</p>
                                        </div>

                                        <div class="form-group">
                                            <h6><strong>Kategori</strong></h6>
                                            <p>{{ $data_lkp->kategori ?? 'Belum Ditentukan' }}</p>
                                        </div>

                                        <div class="form-group">
                                            <h6><strong>Kota/Kabupaten</strong></h6>
                                            <p>{{ $data_lkp->relasi_kota->kota ?? 'Belum Ditentukan' }}</p>
                                        </div>

                                        <div class="form-group">
                                            <h6><strong>Deskripsi</strong></h6>
                                            <p>{{ $data_lkp->deskripsi ?? 'Belum Ditentukan' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($data_lkp->path == null)
                                            <img class="img-fluid" src="{{ asset('All/img/no_image.jpg') }}"
                                                alt="Card image cap">
                                        @else
                                            <img class="img-fluid" src="{{ asset('storage/' . $data_lkp->path) }}"
                                                style="aspect-ratio:1/1; border-radius: 1rem;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kata-sandi" role="tabpanel" aria-labelledby="kata-sandi-tab">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <form id="form-EditPassword" method="POST"
                                            action="{{ route('lembaga.EditDataInformasiPengguna') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="basicInput">Password Lama</label>
                                                <div class="form-group position-relative has-icon-right">
                                                    <input name="passwordlama" type="password" class="form-control"
                                                        id="passwordlama" />
                                                    <div class="form-control-icon" onclick="password_show_hide1();">
                                                        <i class="bi bi-eye" id="show_eye"></i>
                                                        <i class="bi bi-eye-slash d-none" id="hide_eye"></i>
                                                    </div>
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text passwordlama_error"></label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="helpInputTop">Password Baru</label>
                                                <div class="form-group position-relative has-icon-right">
                                                    <input name="password" type="password" class="input form-control"
                                                        id="password" />
                                                    <div class="form-control-icon" onclick="password_show_hide2();">
                                                        <i class="bi bi-eye" id="show_eye2"></i>
                                                        <i class="bi bi-eye-slash d-none" id="hide_eye2"></i>
                                                    </div>
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text password_error"></label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="helperText">Konfirmasi Password</label>
                                                <div class="form-group position-relative has-icon-right">
                                                    <input name="konfirmasipasswordbaru" type="password"
                                                        class="input form-control" id="konfirmasipasswordbaru" />
                                                    <div class="form-control-icon" onclick="password_show_hide3();">
                                                        <i class="bi bi-eye" id="show_eye3"></i>
                                                        <i class="bi bi-eye-slash d-none" id="hide_eye3"></i>
                                                    </div>
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text konfirmasipasswordbaru_error"></label>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary ml-1">
                                                Simpan
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                    <div class="card-body">
                        <div class="card-header mb-2">
                            <h4>Daftar Entrepreneur</h4>
                        </div>


                        <table class="table table-striped" id="table-data-daftar-entrepreneur">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th>Kode Pengguna</th>
                                    <th>Status Bayar</th>
                                    <th>Bukti Bayar</th>
                                    <th>Status Akun</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade text-left" id="modalPembayaranPengguna" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Pembayaran</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formPembayaranPengguna" action="{{ route('admin.PembayaranPengguna') }}" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" hidden readonly>
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="nama_pengguna">Nama
                                    Pengguna</label>
                                <input type="text" class="form-control" name="nama_pengguna" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="email_pengguna">Email</label>
                                <input type="text" class="form-control" name="email_pengguna" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="total_bayar">Total Bayar</label>
                                <input name="total_bayar" id="edit_total_bayar" class="form-control">
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text total_bayar_error"></label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="path">Gambar Bukti
                                    Bayar</label>
                                <input type="file" name="path" class="form-control">
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text path_error"></label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="judul">Status</label>
                                <select name="status_id" class="form-control">
                                    <option value="" selected disabled>-- Pilih Status Transaksi
                                        --</option>
                                    @foreach ($status_transaksi as $status)
                                        <option value="{{ $status->id }}">{{ $status->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text status_id_error"></label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="path">Catatan
                                    (Opsional)</label>
                                <textarea name="catatan" class="form-control"></textarea>
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text catatan_error"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary batal" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" id="button-konfirmasi-pembayaran">
                            <i id="icon-button-konfirmasi-pembayaran"></i>
                            <span id="text-konfirmasi-pembayaran" class="d-none d-sm-block">
                                Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let daftar_data_pengguna = [];
        const table_data_pengguna = $('#table-data-daftar-entrepreneur').DataTable({
            "destroy": true,
            "pageLength": 10,
            "lengthMenu": false,
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": true,
            "processing": true,
            "bServerSide": true,
            "responsive": false,
            "sScrollX": '100%',
            "sScrollXInner": "100%",
            "searching": true,
            ajax: {
                url: "{{ route('admin.DataPenggunaEntrepreneur', $data_lkp->id) }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // data: function(d) {
                //     d.role_pengguna = data_role_pengguna;
                //     d.jurusan_pengguna = data_filter_jurusan;
                //     return d
                // }
            },
            columnDefs: [{
                    targets: '_all',
                    visible: true
                },
                {
                    "targets": 0,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let i = 1;
                        daftar_data_pengguna[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        return row.relasi_user.name;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        return row.relasi_user.email;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        return row.relasi_user.kode;
                    }
                },
                {
                    "targets": 4,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        if (row.relasi_user.relasi_transaksi == null) {
                            return 'Belum Membayar'
                        } else {
                            return 'Sudah Membayar'
                        }
                    }

                },
                {
                    "targets": 5,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        if (row.relasi_user.relasi_transaksi == null) {
                            return `<img src="/All/img/no_image.jpg" width="100">`
                        } else {
                            return `<img src="/storage/${row.path}" width="100" style="aspect-ratio:1/1; border-radius: 1rem;">`
                        }
                    }

                },
                {
                    "targets": 6,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        return row.relasi_status_akun.status
                    }

                },
                {
                    "targets": 7,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        if (row.path == null) {
                            return `<img src="/All/img/no_image.jpg" width="100">`
                        } else {
                            return `<img src="/storage/${row.path}" width="100" style="aspect-ratio:1/1; border-radius: 1rem;">`
                        }
                    }

                },
                {
                    "targets": 8,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        if (row.status_akun_id == 1) {
                            tampilan = `<button type="button" class="btn btn-danger btn-sm nonaktifkan_akun" id-entrepreneur = "${row.id}" href="#!"><i class="fas fa-user-slash"></i></button>
                                    `
                        } else if (row.status_akun_id == 2) {
                            tampilan = `
                                    <button type="button" class="btn btn-success btn-sm pembayaran" id-entrepreneur = "${row.id}" href="#!"><i class="fas fa-upload"></i></button>
                                    <button type="button" class="btn btn-warning btn-sm aktifkan_akun" id-entrepreneur = "${row.id}" href="#!"><i class="fas fa-user-alt"></i></button>
                                `
                        }
                        return tampilan;
                    }
                },
            ]
        });

        $(document).on('click', '.pembayaran', function(event) {
            const id = $(event.currentTarget).attr('id-entrepreneur');
            const data_transaksi = daftar_data_pengguna[id];
            $("#modalPembayaranPengguna").modal('show')
            $("#formPembayaranPengguna [name='id']").val(id)
            $("#formPembayaranPengguna [name='nama_pengguna']").val(data_transaksi.relasi_user.name)
            $("#formPembayaranPengguna [name='email_pengguna']").val(data_transaksi.relasi_user.email)

        });

        $('#formPembayaranPengguna').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-konfirmasi-pembayaran")
            $("#icon-button-konfirmasi-pembayaran").addClass("fa fa-spinner fa-spin")
            $("#text-konfirmasi-pembayaran").html('')
            $("#button-konfirmasi-pembayaran").prop('disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('label.error-text').text('');
                },
                success: function(data) {
                    if (data.status_form_kosong == 1) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-konfirmasi-pembayaran").html(
                            '<span id="text-konfirmasi-pembayaran" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-konfirmasi-pembayaran").prop('disabled', false);
                    } else if (data.status_berhasil == 1) {
                        $("#modalPembayaranPengguna").modal('hide');
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: data.msg
                        })
                        table_data_pengguna.draw();
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-konfirmasi-pembayaran").html(
                            '<span id="text-konfirmasi-pembayaran" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-konfirmasi-pembayaran").prop('disabled', false);
                        $(document).find('label.error-text').text('');
                        $("#formPembayaranPengguna [name='users_id']").empty().append('');
                        $("#formPembayaranPengguna [name='status_id']").empty().append('');
                    }
                }
            });
        });

        $(document).on('click', '.nonaktifkan_akun', function(event) {
            const id = $(event.currentTarget).attr('id-entrepreneur');
            const data_pembayaran = daftar_data_pengguna[id];
            Swal.fire({
                title: 'Yakin ingin menonaktifkan akun ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/nonaktifkan-akun/" + id,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 0) {
                                alert("Gagal Hapus")
                            } else if (data.status_berhasil == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave', Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                        icon: 'success',
                                        title: data.msg
                                    }),
                                    table_data_pengguna.ajax.reload()
                            }
                        }
                    });
                } else {
                    //alert ('no');
                    return false;
                }
            });
        });

        $(document).on('click', '.aktifkan_akun', function(event) {
            const id = $(event.currentTarget).attr('id-entrepreneur');
            const data_pembayaran = daftar_data_pengguna[id];
            Swal.fire({
                title: 'Yakin ingin mengaktifkan akun ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/aktifkan-akun/" + id,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 0) {
                                alert("Gagal Hapus")
                            } else if (data.status_berhasil == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave', Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                        icon: 'success',
                                        title: data.msg
                                    }),
                                    table_data_pengguna.ajax.reload()
                            }
                        }
                    });
                } else {
                    //alert ('no');
                    return false;
                }
            });
        });

        var edit_total_bayar_lkp = document.getElementById(`edit_total_bayar`);
        edit_total_bayar_lkp.addEventListener('keyup', function(e) {
            edit_total_bayar_lkp.value = formatRupiah(this.value, 'Rp. ');
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection

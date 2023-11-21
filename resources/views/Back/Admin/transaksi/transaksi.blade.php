@extends('Back.layout.master', ['title' => 'Data Transaksi'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalTambahDataTransaksi"><i class="bi bi-plus"></i> Tambah Transaksi</button>

                        <div class="modal fade text-left" id="modalTambahDataTransaksi" data-bs-backdrop="static"
                            data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah Transaksi</h4>
                                        <button type="button" class="close batal" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.TambahDataTransaksi') }}" id="formTambahDataTransaksi"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="judul">Pengguna</label>
                                                    <select name="users_id" class="form-control pengguna_id"
                                                        id="tmb_pengguna_id">
                                                        <option value="" selected disabled>-- Pilih Kode Pengguna --
                                                        </option>
                                                        @foreach ($data_pengguna as $pengguna)
                                                            <option value="{{ $pengguna->id }}">{{ $pengguna->kode }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text users_id_error"></label>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="nama_pengguna">Nama
                                                        Pengguna</label>
                                                    <input type="text" class="form-control" id="nama_pengguna" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="email_pengguna">Email</label>
                                                    <input type="text" class="form-control" id="email_pengguna" readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="total_bayar">Total Bayar</label>
                                                    <input name="total_bayar" id="tmb_total_bayar" class="form-control">
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
                                                            <option value="{{ $status->id }}">{{ $status->status }}
                                                            </option>
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
                                            <button type="button" class="btn btn-light-secondary batal"
                                                data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1">
                                                Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="table-data-slider">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Transaksi</th>
                                    <th>Kode Pengguna</th>
                                    <th>Total Bayar</th>
                                    <th>Bukti Bayar</th>
                                    <th>Tanggal Konfirmasi</th>
                                    <th>Status</th>
                                    <th>Catatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade text-left" id="modalEditDataTransaksi" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Lembaga</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditDataTransaksi" action="{{ route('admin.EditDataTransaksi') }}" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" hidden readonly>
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="judul">Pengguna</label>
                                <select name="users_id" class="form-control" id="edit_pengguna_id">
                                    <option value="" selected disabled>-- Pilih Kode Pengguna --
                                    </option>
                                </select>
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text users_id_error"></label>
                            </div>
                        </div>
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
                        <button type="submit" class="btn btn-primary ml-1">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#tmb_pengguna_id").select2({
            theme: "bootstrap-5",
            dropdownParent: $("#tmb_pengguna_id").parent(), // Required for dropdown styling
        });

        $("#tmb_pengguna_id").change(function() {
            var pengguna_id = $(this).val();
            $.ajax({
                url: "{{ route('admin.TampilDataPenggunaDariKode') }}",
                method: "GET",
                data: {
                    pengguna_id: pengguna_id,
                },
                success: function(data) {
                    $('#nama_pengguna').val(data.data_pengguna.name);
                    $('#email_pengguna').val(data.data_pengguna.email)
                }
            });
        });

        $("#edit_pengguna_id").select2({
            theme: "bootstrap-5",
            dropdownParent: $("#edit_pengguna_id").parent(), // Required for dropdown styling
        });

        $("#edit_pengguna_id").change(function() {
            var pengguna_id = $(this).val();
            $.ajax({
                url: "{{ route('admin.TampilDataPenggunaDariKode') }}",
                method: "GET",
                data: {
                    pengguna_id: pengguna_id,
                },
                success: function(data) {
                    $("#formEditDataTransaksi [name='nama_pengguna']").val(data.data_pengguna.name)
                    $("#formEditDataTransaksi [name='email_pengguna']").val(data.data_pengguna.email)
                }
            });
        });

        let daftar_data_transaksi = [];
        const table_data_transaksi = $('#table-data-slider').DataTable({
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
            ajax: {
                url: "{{ route('admin.DataTransaksi') }}",
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
                        daftar_data_transaksi[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_transaksi[row.id] = row;
                        return row.kode;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_transaksi[row.id] = row;
                        return row.relasi_user.kode;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_transaksi[row.id] = row;
                        return $.fn.dataTable.render.number('.', ',', 2, 'Rp ').display(row.total_bayar);
                    }
                },
                {
                    "targets": 4,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_transaksi[row.id] = row;
                        if (row.path == null) {
                            return `<img src="/All/img/no_image.jpg" width="100">`
                        } else {
                            return `<img src="/storage/${row.path}" width="100">`
                        }

                    }
                },
                {
                    "targets": 5,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_transaksi[row.id] = row;
                        return moment(row.created_at).format('DD-MMMM-YYYY');
                    }
                },
                {
                    "targets": 6,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_transaksi[row.id] = row;
                        return row.relasi_status_transaksi.status;
                    }
                },
                {
                    "targets": 7,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_transaksi[row.id] = row;
                        return row.catatan;
                    }
                },
                {
                    "targets": 8,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                            <div class="ms-auto">
                                <button type="button" class="btn btn-warning btn-sm edit_transaksi" id-transaksi = "${row.id}" href="#!">Edit</button>
                                <button type="button" class="btn btn-danger btn-sm hapus_transaksi" id-transaksi = "${row.id}" href="#!">Hapus</button>
                            </div>
                            `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_transaksi" id-transaksi = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        $('#formTambahDataTransaksi').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $(document).find('label.error-text').text('');
                },
                success: function(data) {
                    if (data.status_form_kosong == 1) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
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
                        })
                        table_data_transaksi.draw();
                        $("#formTambahDataTransaksi").trigger('reset');
                        $("#modalTambahDataTransaksi").modal('hide');
                    } else if (data.status_sudah_transaksi == 1) {
                        $("#modalEditDataTransaksi").modal('hide');
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
                            icon: 'error',
                            title: data.msg
                        })
                        $("#modalTambahDataTransaksi").modal('hide');
                        $('#formTambahDataTransaksi').trigger("reset");
                    }
                },
            });
        });

        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#formEditDataTransaksi [name='users_id']").empty().append('');
            $("#formEditDataTransaksi [name='status_id']").empty().append('');
        })

        let pengguna = @json($data_pengguna);
        let status = @json($status_transaksi);

        $(document).on('click', '.edit_transaksi', function(event) {
            const id = $(event.currentTarget).attr('id-transaksi');
            const data_transaksi = daftar_data_transaksi[id];
            $("#modalEditDataTransaksi").modal('show')
            $("#formEditDataTransaksi [name='id']").val(id)
            $("#formEditDataTransaksi [name='nama_pengguna']").val(data_transaksi.relasi_user.name)
            $("#formEditDataTransaksi [name='email_pengguna']").val(data_transaksi.relasi_user.email)
            $("#formEditDataTransaksi [name='total_bayar']").val(data_transaksi.total_bayar)
            $("#formEditDataTransaksi [name='catatan']").val(data_transaksi.catatan)
            // $.each(pengguna, function(key, value) {
            $("#formEditDataTransaksi [name='users_id']")
                .append(
                    `<option value="${data_transaksi.users_id}" ${data_transaksi.users_id ? 'selected' : ''}>${data_transaksi.relasi_user.kode}</option>`
                )
            // });
            $.each(status, function(key, value) {
                $("#formEditDataTransaksi [name='status_id']")
                    .append(
                        `<option value="${value.id}" ${value.id == data_transaksi.status_id ? 'selected' : ''}>${value.status}</option>`
                    )
            });
        });

        $('#formEditDataTransaksi').on('submit', function(e) {
            e.preventDefault();
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
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
                    } else if (data.status == 1) {
                        $("#modalEditDataTransaksi").modal('hide');
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
                        $(document).find('label.error-text').text('');
                        $("#formEditDataTransaksi [name='users_id']").empty().append('');
                        $("#formEditDataTransaksi [name='status_id']").empty().append('');
                        table_data_transaksi.ajax.reload(null, false);
                    }
                }
            });
        });


        $(document).on('click', '.hapus_transaksi', function(event) {
            const id = $(event.currentTarget).attr('id-transaksi');

            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-transaksi/" + id,
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 0) {
                                alert("Gagal Hapus")
                            } else if (data.status == 1) {
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
                                    table_data_transaksi.ajax.reload()
                            }
                        }
                    });
                } else {
                    //alert ('no');
                    return false;
                }
            });
        });

        var tmb_total_bayar_lkp = document.getElementById(`tmb_total_bayar`);
        tmb_total_bayar_lkp.addEventListener('keyup', function(e) {
            tmb_total_bayar_lkp.value = formatRupiah(this.value, 'Rp. ');
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

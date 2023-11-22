@extends('Back.layout.master', ['title' => 'Data Pengguna'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                    <div class="card-body">
                        <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalTambahDataPengguna"><i class="bi bi-plus"></i> Tambah Pengguna</button>

                        <div class="modal fade text-left" id="modalTambahDataPengguna" data-bs-backdrop="static"
                            data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah Pengguna</h4>
                                        <button type="button" class="close batal" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form id="formTambahDataPengguna" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="lkp">Nama
                                                        Pengguna/Lembaga</label>
                                                    <input name="lkp" class="form-control"
                                                        placeholder="Name Pengguna/Lembaga">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text lkp_error"></label>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="email">Email Pengguna</label>
                                                    <input type="email" name="email" class="form-control"
                                                        placeholder="Email Pengguna">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text email_error"></label>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="password">Password</label>
                                                    <input type="password" name="password" class="form-control"
                                                        placeholder="Password">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text password_error"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary batal"
                                                data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1"
                                                id="button-tambah-pengguna-lkp">
                                                <i id="icon-button-tambah-pengguna-lkp"></i>
                                                <span id="text-tambah-pengguna-lkp" class="d-none d-sm-block">
                                                    Simpan</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="table-data-pengguna">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
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

    <div class="modal fade text-left" id="modalEditDataPengguna" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Pengguna</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditDataPengguna" action="{{ route('admin.EditDataPengguna') }}" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" hidden>
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="name">Nama Pengguna</label>
                                <input name="lkp" class="form-control" placeholder="Nama Pengguna">
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text lkp_error"></label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="email">Email Pengguna/Lembaga</label>
                                <input type="email" name="email" class="form-control" placeholder="Email Pengguna">
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text email_error"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary batal" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" id="button-ubah-pengguna-lkp">
                            <i id="icon-button-ubah-pengguna-lkp"></i>
                            <span id="text-ubah-pengguna-lkp" class="d-none d-sm-block">
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
        const table_data_pengguna = $('#table-data-pengguna').DataTable({
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
            "searching": true,
            "sScrollXInner": "100%",
            ajax: {
                url: "{{ route('admin.DataPengguna') }}",
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
                        return row.relasi_lkp.lkp;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        return row.email;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_pengguna[row.id] = row;
                        if (row.path == null) {
                            return `<img src="/All/img/no_image.jpg" width="100">`
                        } else {
                            return `<img src="/storage/${row.path}" width="100">`
                        }
                    }
                },
                {
                    "targets": 4,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                                <div class="ms-auto">
                                    <a class="btn btn-sm btn-success" href="/admin/detail-pengguna/${row.relasi_lkp.slug}">Detail</a>
                                    <button type="button" class="btn btn-warning btn-sm edit_pengguna" id-pengguna = "${row.id}" href="#!">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm hapus_pengguna" id-pengguna = "${row.id}" href="#!">Hapus</button>
                                </div>
                                `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_pengguna" id-pengguna = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#formTambahDataPengguna").trigger('reset');
        })

        $('#formTambahDataPengguna').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-tambah-pengguna-lkp")
            $("#icon-button-tambah-pengguna-lkp").addClass("fa fa-spinner fa-spin")
            $("#text-tambah-pengguna-lkp").html('')
            $("#button-tambah-pengguna-lkp").prop('disabled', true);
            $.ajax({
                url: "{{ route('admin.TambahDataPengguna') }}",
                method: "POST",
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
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-tambah-pengguna-lkp").html(
                            '<span id="text-tambah-pengguna-lkp" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-pengguna-lkp").prop('disabled', false);
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
                        table_data_pengguna.draw();
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-tambah-pengguna-lkp").html(
                            '<span id="text-tambah-pengguna-lkp" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-pengguna-lkp").prop('disabled', false);
                        $("#formTambahDataPengguna").trigger('reset');
                        $("#modalTambahDataPengguna").modal('hide');
                    }
                },
            });
        });

        $(document).on('click', '.edit_pengguna', function(event) {
            const id = $(event.currentTarget).attr('id-pengguna');
            const data_pengguna = daftar_data_pengguna[id];
            $("#modalEditDataPengguna").modal('show')
            $("#formEditDataPengguna [name='id']").val(id)
            $("#formEditDataPengguna [name='lkp']").val(data_pengguna.relasi_lkp.lkp);
            $("#formEditDataPengguna [name='email']").val(data_pengguna.email);
        });

        $('#formEditDataPengguna').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-ubah-pengguna-lkp")
            $("#icon-button-ubah-pengguna-lkp").addClass("fa fa-spinner fa-spin")
            $("#text-ubah-pengguna-lkp").html('')
            $("#button-ubah-pengguna-lkp").prop('disabled', true);
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
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-ubah-pengguna-lkp").html(
                            '<span id="text-ubah-pengguna-lkp" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-ubah-pengguna-lkp").prop('disabled', false);
                    } else if (data.status == 1) {
                        $("#modalEditDataPengguna").modal('hide');
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
                        $("#text-ubah-pengguna-lkp").html(
                            '<span id="text-ubah-pengguna-lkp" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-ubah-pengguna-lkp").prop('disabled', false);
                        $("#formEditDataPengguna").trigger('reset');
                        $("#modalEditDataPengguna").modal('hide');
                    }
                }
            });
        });

        $(document).on('click', '.hapus_pengguna', function(event) {
            const id = $(event.currentTarget).attr('id-pengguna');

            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/admin/hapus-data-pengguna/" + id,
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
    </script>
@endsection

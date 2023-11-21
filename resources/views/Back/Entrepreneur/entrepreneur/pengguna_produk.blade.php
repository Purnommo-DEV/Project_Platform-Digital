@extends('Back.layout.master', ['title' => 'Data Produk'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                    <div class="card-body">
                        <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalTambahDataGambarProdukPengguna"><i class="bi bi-plus"></i>
                            Tambah Gambar Produk</button>
                        <div class="modal fade text-left" id="modalTambahDataGambarProdukPengguna" data-bs-backdrop="static"
                            data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Gambar Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('entrepreneur.TambahDataGambarProdukPengguna') }}"
                                            id="formTambahDataGambarProdukPengguna" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row align-items-end">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="nama-produk" class="col-form-label">Nama
                                                            Produk</label>
                                                        <input type="text" class="form-control" name="nama_gambar"
                                                            multiple>
                                                        <div class="input-group has-validation">
                                                            <label
                                                                style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                                class="text-danger error-text nama_gambar_error"></label>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nama-produk" class="col-form-label">Gambar
                                                            Produk (Portrait)</label>
                                                        <input type="file" accept="image/*"
                                                            class="form-control imageUpload" name="path" multiple>
                                                        <div class="input-group has-validation">
                                                            <label
                                                                style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                                class="text-danger error-text path_error"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row imageOutput"></div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary batal"
                                                    data-bs-dismiss="modal">
                                                    Batal
                                                </button>
                                                <button type="submit" class="btn btn-primary ml-1"
                                                    id="button-tambah-produk-siswa">
                                                    <i id="icon-button-tambah-produk-siswa"></i>
                                                    <span id="text-tambah-produk-siswa" class="d-none d-sm-block">
                                                        Simpan</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="table-data-produk-pengguna">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
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

    <div class="modal fade text-left" id="modalEditDataGambarProdukPengguna" data-bs-backdrop="static"
        data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Gambar Produk</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditDataGambarProdukPengguna"
                    action="{{ route('entrepreneur.EditDataGambarProdukPengguna') }}" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" hidden>
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="nama_gambar">Nama Produk</label>
                                <input name="nama_gambar" class="form-control" placeholder="Nama Produk">
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text nama_gambar_error"></label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="path">Gambar (Portrait)</label>
                                <input type="file" name="path" class="form-control">
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text path_error"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary batal" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" id="button-ubah-produk-siswa">
                            <i id="icon-button-ubah-produk-siswa"></i>
                            <span id="text-ubah-produk-siswa" class="d-none d-sm-block">
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
        let daftar_data_produk_pengguna = [];
        const table_data_produk_pengguna = $('#table-data-produk-pengguna').DataTable({
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
                url: "{{ route('entrepreneur.DataProdukPengguna') }}",
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
                        daftar_data_produk_pengguna[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_produk_pengguna[row.id] = row;
                        return row.nama_gambar
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_produk_pengguna[row.id] = row;
                        if (row.path == null) {
                            return `<img src="/All/img/no_image.jpg" width="60">`
                        } else {
                            return `<img src="/storage/${row.path}" width="60%" style="aspect-ratio:1/1; border-radius:1rem;">`
                        }
                    }
                },
                {
                    "targets": 3,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                        <div class="ms-auto">
                            <button type="button" class="btn btn-success btn-sm edit_produk_pengguna" id-produk-pengguna = "${row.id}" href="#!">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm hapus_produk_pengguna" id-produk-pengguna = "${row.id}" href="#!">Hapus</button>
                        </div>
                        `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_lkp_sosmed" id-produk-pengguna = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#formEditDataGambarProdukPengguna").trigger('reset');
            $("#formTambahDataGambarProdukPengguna").trigger('reset');
        })

        $(document).on('click', '.edit_produk_pengguna', function(event) {
            const id = $(event.currentTarget).attr('id-produk-pengguna');
            const data_produk_pengguna = daftar_data_produk_pengguna[id];
            $("#modalEditDataGambarProdukPengguna").modal('show')
            $("#formEditDataGambarProdukPengguna [name='id']").val(id)
            $("#formEditDataGambarProdukPengguna [name='nama_gambar']").val(data_produk_pengguna.nama_gambar);
        });

        $('#formEditDataGambarProdukPengguna').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-ubah-produk-siswa")
            $("#icon-button-ubah-produk-siswa").addClass("fa fa-spinner fa-spin")
            $("#text-ubah-produk-siswa").html('')
            $("#button-ubah-produk-siswa").prop('disabled', true);
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
                        $("#text-ubah-produk-siswa").html(
                            '<span id="text-ubah-produk-siswa" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-ubah-produk-siswa").prop('disabled', false);
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
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-ubah-produk-siswa").html(
                            '<span id="text-ubah-produk-siswa" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-ubah-produk-siswa").prop('disabled', false);
                        $("#modalEditDataGambarProdukPengguna").modal('hide');
                        table_data_produk_pengguna.ajax.draw();
                    }
                }
            });
        });


        $('#formTambahDataGambarProdukPengguna').on('submit', function(e) {
            e.preventDefault();
            // Spinner Simpan
            var $search = $("#icon-button-tambah-produk-siswa")
            $("#icon-button-tambah-produk-siswa").addClass("fa fa-spinner fa-spin")
            $("#text-tambah-produk-siswa").html('')
            $("#button-tambah-produk-siswa").prop('disabled', true);
            // --
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
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
                        // Spinner Simpan
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-tambah-produk-siswa").html(
                            '<span id="text-tambah-produk-siswa" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-produk-siswa").prop('disabled', false);
                        // --
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
                        })
                        // Spinner Simpan
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#button-tambah-produk-siswa").prop('disabled', false);
                        $("#text-tambah-produk-siswa").html(
                            '<span id="text-tambah-produk-siswa" class="d-none d-sm-block">Simpan</span>'
                        )
                        // ---
                        $("#formTambahDataGambarProdukPengguna").trigger('reset');
                        $("#modalTambahDataGambarProdukPengguna").modal('hide');
                        table_data_produk_pengguna.draw();
                    }
                },
            });
        });

        $(document).on('click', '.hapus_produk_pengguna', function(event) {
            const id = $(event.currentTarget).attr('id-produk-pengguna');

            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/entrepreneur/hapus-data-gambar-produk-pengguna/" + id,
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
                                    table_data_produk_pengguna.ajax.reload()
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

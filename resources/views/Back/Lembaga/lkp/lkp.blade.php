@extends('Back.layout.master', ['title' => 'Data Lembaga Kursus dan Pelatihan'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                    <div class="card-body">
                        <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalTambahDataLKP"><i class="bi bi-plus"></i> Tambah LKP</button>

                        <div class="modal fade text-left" id="modalTambahDataLKP" data-bs-backdrop="static"
                            data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah LKP</h4>
                                        <button type="button" class="close batal" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('lembaga.TambahDataLKP') }}" id="formTambahDataLKP"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="lkp">Nama Lembaga Kursus dan
                                                        Pelatihan</label>
                                                    <input name="lkp" class="form-control"
                                                        placeholder="Lembaga Kursus dan Pelatihan">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text lkp_error"></label>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="deskripsi">Deskripsi</label>
                                                    <textarea name="deskripsi" class="form-control" placeholder="Deskripsi"></textarea>
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text deskripsi_error"></label>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="deskripsi">Kategori</label>
                                                    <select name="kategori_id" id="kategori-id" class="form-control">
                                                        <option value="" selected disabled> -- Pilih Kategori --
                                                        </option>
                                                        @foreach ($kategori as $data_kategori)
                                                            <option value="{{ $data_kategori->id }}">
                                                                {{ $data_kategori->kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text kategori_id_error"></label>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="path">Gambar</label>
                                                    <input type="file" name="path" class="form-control">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text path_error"></label>
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
                        <table class="table table-striped" id="table-data-lkp">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Lembaga Kursus dan Pelatihan</th>
                                    <th>Deskripsi</th>
                                    <th>Kategori</th>
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

    <div class="modal fade text-left" id="modalEditDataLKP" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Lembaga</h4>
                    <button type="button" class="close batal" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form id="formEditDataLKP" action="{{ route('lembaga.EditDataLKP') }}" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="id" hidden>
                    @csrf
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="lkp">Nama Lembaga Kursus dan
                                    Pelatihan</label>
                                <input name="lkp" class="form-control" placeholder="Lembaga Kursus dan Pelatihan">
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text lkp_error"></label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" placeholder="Deskripsi"></textarea>
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text deskripsi_error"></label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="kategori_id">Kategori</label>
                                <select name="kategori_id" id="kategori-id" class="form-control">
                                </select>
                            </div>
                            <div class="input-group has-validation">
                                <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                    class="text-danger error-text kategori_id_error"></label>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="col col-form-label" for="path">Gambar</label>
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
        let daftar_data_lkp = [];
        const table_data_lkp = $('#table-data-lkp').DataTable({
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
                url: "{{ route('lembaga.DataLKP') }}",
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
                        daftar_data_lkp[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_lkp[row.id] = row;
                        return row.lkp;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_lkp[row.id] = row;
                        return row.deskripsi;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_lkp[row.id] = row;
                        if (row.kategori_id == null) {
                            return '-';
                        } else {
                            return row.relasi_kategori.kategori;
                        }
                    }
                },
                {
                    "targets": 4,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_lkp[row.id] = row;
                        if (row.path == null) {
                            return `<img src="/All/img/no_image.jpg" width="100">`
                        } else {
                            return `<img src="/storage/${row.path}" width="100">`
                        }
                    }
                },
                {
                    "targets": 5,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                                <div class="ms-auto">
                                    <a href="/lembaga/detail-lkp/${row.slug}" class="btn btn-success btn-sm">Detail</a>
                                    <button type="button" class="btn btn-warning btn-sm edit_lkp" id-lkp = "${row.id}">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm hapus_lkp" id-lkp = "${row.id}">Hapus</button>
                                </div>
                                `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_lkp" id-lkp = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        $('#formTambahDataLKP').on('submit', function(e) {
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
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
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
                        table_data_lkp.draw();
                        $("#formTambahDataLKP").trigger('reset');
                        $("#formEditDataLKP [name='kategori_id']").empty().append('');
                        $("#modalTambahDataLKP").modal('hide');
                    }
                },
            });
        });

        let kategori = @json($kategori);

        $(document).on('click', '.edit_lkp', function(event) {
            const id = $(event.currentTarget).attr('id-lkp');
            const data_lkp = daftar_data_lkp[id];
            $("#modalEditDataLKP").modal('show')
            $("#formEditDataLKP [name='id']").val(id)
            $("#formEditDataLKP [name='lkp']").val(data_lkp.lkp);
            $("#formEditDataLKP [name='deskripsi']").val(data_lkp.deskripsi);
            $.each(kategori, function(key, value) {
                $("#formEditDataLKP [name='kategori_id']")
                    .append(
                        `<option value="${value.id}" ${value.id == data_lkp.kategori_id ? 'selected' : ''}>${value.kategori}</option>`
                    )
            });
        });

        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#kategori_id").empty().append('');
            $("#formEditDataLKP [name='kategori_id']").empty().append('');
        })


        $('#formEditDataLKP').on('submit', function(e) {
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
                        $("#modalEditDataLKP").modal('hide');
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
                        $("#formEditDataLKP [name='kategori_id']").empty().append('');
                        table_data_lkp.ajax.reload(null, false);
                    }
                }
            });
        });

        $(document).on('click', '.hapus_lkp', function(event) {
            const id = $(event.currentTarget).attr('id-lkp');

            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/lembaga/hapus-data-lkp/" + id,
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
                                    table_data_lkp.ajax.reload()
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

@extends('Back.layout.master', ['title' => 'Data Sosial Media'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15); border-radius:10px;">
                    <div class="card-body">
                        <button type="button" class="btn btn-light btn-sm mt-2 mb-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#modalTambahDataLKPSosmed"><i class="bi bi-plus"></i>Tambah Sosial
                            Media</button>

                        <div class="modal fade text-left" id="modalTambahDataLKPSosmed" data-bs-backdrop="static"
                            data-bs-keyboard="false" aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Tambah Sosial Media</h4>
                                        <button type="button" class="close batal" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <form action="{{ route('lembaga.TambahDataLKPSosmed') }}" id="formTambahDataLKPSosmed"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="link_sosmed">Link Sosial
                                                        Media</label>
                                                    <input name="link_sosmed" class="form-control"
                                                        placeholder="Link Sosial Media">
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text link_sosmed_error"
                                                        style="
                                                    margin-top: 0.2rem;
                                                    font-size: 0.8rem;
                                                    font-weight: 600;
                                                "></label>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label class="col col-form-label" for="icon">Pilih Sosial
                                                        Media</label>
                                                    <select name="sosmed" class="form-control">
                                                        <option value="" selected disabled>-- Pilih Sosial Media --
                                                        </option>
                                                        <option value="instagram">Instagram</option>
                                                        <option value="facebook">Facebook</option>
                                                        <option value="linkedin">Linkedin</option>
                                                        <option value="twitter">Twitter</option>
                                                        <option value="whatsapp">Whatsapp</option>
                                                    </select>
                                                </div>
                                                <div class="input-group has-validation">
                                                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                        class="text-danger error-text sosmed_error"
                                                        style="margin-top: 0.2rem; font-size: 0.8rem;font-weight: 600;"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary batal"
                                                data-bs-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary ml-1"
                                                id="button-tambah-sosmed-lkp">
                                                <i id="icon-button-tambah-sosmed-lkp"></i>
                                                <span id="text-tambah-sosmed-lkp" class="d-none d-sm-block">
                                                    Simpan</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="table-data-lkp-sosmed">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Link</th>
                                    <th>Sosial Media</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        let daftar_data_lkp_sosmed = [];
        let lkp_id = @json($data_lkp->id);
        const table_data_lkp_sosmed = $('#table-data-lkp-sosmed').DataTable({
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
                url: `/lembaga/data-lkp-sosmed/${lkp_id}`,
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
                        daftar_data_lkp_sosmed[row.id] = row;
                        return meta.row + 1;
                    }
                },
                {
                    "targets": 1,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_lkp_sosmed[row.id] = row;
                        return `<a href="${row.link_sosmed}">Link</a>`;
                    }
                },
                {
                    "targets": 2,
                    "class": "text-wrap text-center",
                    "render": function(data, type, row, meta) {
                        daftar_data_lkp_sosmed[row.id] = row;
                        return `<i class="fa-brands fa-${row.sosmed}"></i>`;
                    }
                },
                {
                    "targets": 3,
                    "class": "text-nowrap text-center",
                    "render": function(data, type, row, meta) {
                        let tampilan;
                        tampilan = `
                        <div class="ms-auto">
                            <button type="button" class="btn btn-danger btn-sm hapus_lkp_sosmed" id-lkp-sosmed = "${row.id}" href="#!">Hapus</button>
                        </div>
                        `
                        // <a class="btn btn-link text-dark text-gradient px-3 mb-0 edit_lkp_sosmed" id-lkp-sosmed = "${row.id}" href="#!" ><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Ubah</a>
                        return tampilan;
                    }
                },
            ]
        });

        $('.batal').on('click', function() {
            $(document).find('label.error-text').text('');
            $("#formTambahDataLKPSosmed").trigger('reset');
        })

        $('#formTambahDataLKPSosmed').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-tambah-sosmed-lkp")
            $("#icon-button-tambah-sosmed-lkp").addClass("fa fa-spinner fa-spin")
            $("#text-tambah-sosmed-lkp").html('')
            $("#button-tambah-sosmed-lkp").prop('disabled', true);
            var data = new FormData(this);
            // Form data (Input tambahan di luar dari Form)
            data.append('req_lkp_id', lkp_id);
            //Custom data
            data.append('key', 'value');
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: data,
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
                        $("#text-tambah-sosmed-lkp").html(
                            '<span id="text-tambah-sosmed-lkp" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-sosmed-lkp").prop('disabled', false);
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
                        table_data_lkp_sosmed.draw();
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-tambah-sosmed-lkp").html(
                            '<span id="text-tambah-sosmed-lkp" class="d-none d-sm-block">Simpan</span>'
                        )
                        $("#button-tambah-sosmed-lkp").prop('disabled', false);
                        $("#formTambahDataLKPSosmed").trigger('reset');
                        $("#modalTambahDataLKPSosmed").modal('hide');

                    }
                },
            });
        });

        $(document).on('click', '.hapus_lkp_sosmed', function(event) {
            const id = $(event.currentTarget).attr('id-lkp-sosmed');

            Swal.fire({
                title: 'Yakin ingin mengahpus data ini?',
                icon: 'warning',
                showDenyButton: true,
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: "/lembaga/hapus-data-lkp-sosmed/" + id,
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
                                    table_data_lkp_sosmed.ajax.reload()
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

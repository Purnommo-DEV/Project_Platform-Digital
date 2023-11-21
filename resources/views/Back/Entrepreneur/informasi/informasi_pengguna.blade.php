@extends('Back.layout.master', ['title' => 'Informasi Pengguna'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Untuk aktivasi akun silahkan hubungi admin, setelah aktivasi data akan muncul ke public. Baca
                    <strong>Syarat dan Ketentuan untuk aktivasi</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
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
                                        <form id="form-EditDataPengguna" enctype="multipart/form-data">
                                            @csrf
                                            <div id="form-informasi-pengguna">
                                                <div class="form-group">
                                                    <label for="basicInput">Nama Pengguna</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        value="{{ $informasi_pengguna->relasi_user->name }}"
                                                        placeholder="Nama Lembaga">
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                            class="text-danger error-text name_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="helpInputTop">Email</label>
                                                    <input type="text" class="form-control" name="email"
                                                        value="{{ $informasi_pengguna->relasi_user->email }}"
                                                        id="email">
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                            class="text-danger error-text email_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="helperText">Lembaga</label>
                                                    <select name="lkp_id" class="form-control" id="lkp_id">
                                                        <option value="" selected disabled>-- Pilih Lembaga --
                                                        </option>
                                                        @foreach ($lembaga as $data_lembaga)
                                                            <option value="{{ $data_lembaga->id }}"
                                                                @if ($data_lembaga->id == $informasi_pengguna->lkp_id) @selected(true) @endif>
                                                                {{ $data_lembaga->lkp }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                            class="text-danger error-text lkp_id_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="helpInputTop">Kategori</label>
                                                    <input type="text" class="form-control" name="kategori"
                                                        value="{{ $informasi_pengguna->kategori }}" id="kategori">
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                            class="text-danger error-text kategori_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="helperText">Kota/Kabupaten</label>
                                                    <select name="kota_id" class="form-control" id="kota_id">
                                                        <option value="" selected disabled>-- Kota/Kabupaten --
                                                        </option>
                                                        @foreach ($kota as $data_kota)
                                                            <option value="{{ $data_kota->id }}"
                                                                @if ($data_kota->id == $informasi_pengguna->kota_id) @selected(true) @endif>
                                                                {{ $data_kota->kota }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                            class="text-danger error-text kota_id_error"></label>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="helperText">Deskripsi</label>
                                                    <textarea type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi Lembaga">{{ $informasi_pengguna->deskripsi }}</textarea>
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                            class="text-danger error-text deskripsi_error"></label>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="helpInputTop">Gambar</label>
                                                    <input type="file" class="form-control" name="path"
                                                        accept="image/png, image/jpg, image/jpeg" id="path">
                                                    <div class="input-group has-validation">
                                                        <label
                                                            style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                            class="text-danger error-text path_error"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary ml-1" id="button-simpan">
                                                <i id="icon-button-simpan"></i>
                                                <span id="text-simpan" class="d-none d-sm-block">
                                                    Simpan</span>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-md-6" id="gambar-preview">
                                        @if ($informasi_pengguna->path == null)
                                            <img class="img-fluid" src="{{ asset('All/img/no_image.jpg') }}"
                                                alt="Card image cap">
                                        @else
                                            <img class="img-fluid"
                                                src="{{ asset('storage/' . $informasi_pengguna->path) }}"
                                                style="aspect-ratio:1/1; border-radius: 1rem;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kata-sandi" role="tabpanel" aria-labelledby="kata-sandi-tab">
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <form id="form-EditPassword" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div id="form-ubah-password">
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
                                                        <label
                                                            style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
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
                                                        <label
                                                            style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
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
                                                        <label
                                                            style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                                                            class="text-danger error-text konfirmasipasswordbaru_error"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary ml-1"
                                                id="button-ubah-password">
                                                <i id="icon-button-ubah-password"></i>
                                                <span id="text-ubah-password" class="d-none d-sm-block">
                                                    Simpan</span>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($informasi_pengguna->path == null)
                                            <img class="img-fluid" src="{{ asset('All/img/no_image.jpg') }}"
                                                alt="Card image cap">
                                        @else
                                            <img class="img-fluid"
                                                src="{{ asset('storage/' . $informasi_pengguna->path) }}"
                                                style="aspect-ratio:1/1; border-radius: 1rem;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $("#lkp_id").select2({
            theme: "bootstrap-5",
            dropdownParent: $("#lkp_id").parent(), // Required for dropdown styling
        });

        $("#kota_id").select2({
            theme: "bootstrap-5",
            dropdownParent: $("#kota_id").parent(), // Required for dropdown styling
        });


        $('#form-EditDataPengguna').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-simpan")
            $("#icon-button-simpan").addClass("fa fa-spinner fa-spin")
            $("#text-simpan").html('')
            $("#button-simpan").prop('disabled', true);
            $.ajax({
                url: "{{ route('entrepreneur.EditDataInformasiPenggunaEntrepreneur', Auth::user()->id) }}",
                method: "POST",
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
                        $("#text-ubah-password").html(
                            '<span id="text-ubah-password" class="d-none d-sm-block">Simpan</span>')
                        $("#button-ubah-password").prop('disabled', false);
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
                        $("#form-informasi-pengguna").load(location.href +
                            " #form-informasi-pengguna>*", "");
                        $("#gambar-preview").load(location.href +
                            " #gambar-preview>*", "");
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-simpan").html(
                            '<span id="text-simpan" class="d-none d-sm-block">Simpan</span>')
                        $("#button-simpan").prop('disabled', false);
                    }
                }
            });
        });

        $('#form-EditPassword').on('submit', function(e) {
            e.preventDefault();
            var $search = $("#icon-button-ubah-password")
            $("#icon-button-ubah-password").addClass("fa fa-spinner fa-spin")
            $("#text-ubah-password").html('')
            $("#button-ubah-password").prop('disabled', true);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('entrepreneur.EditPasswordPenggunaEntrepreneur') }}",
                method: "POST",
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    // $(document).find('span.error-text').text('');
                    $(document).find('label.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {

                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-ubah-password").html(
                            '<span id="text-ubah-password" class="d-none d-sm-block">Simpan</span>')
                        $("#button-ubah-password").prop('disabled', false);
                    } else {
                        $('#form-EditPassword')[0].reset();
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
                        $("#form-ubah-password").load(location.href +
                            " #form-ubah-password>*", "");
                        $search.removeClass("fa fa-spinner fa-spin")
                        $("#text-ubah-password").html(
                            '<span id="text-ubah-password" class="d-none d-sm-block">Simpan</span>')
                        $("#button-ubah-password").prop('disabled', false);
                    }
                }
            });
        });

        function password_show_hide1() {
            var x = document.getElementById("passwordlama");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function password_show_hide2() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye2");
            var hide_eye = document.getElementById("hide_eye2");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }

        function password_show_hide3() {
            var x = document.getElementById("konfirmasipasswordbaru");
            var show_eye = document.getElementById("show_eye3");
            var hide_eye = document.getElementById("hide_eye3");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
@endsection

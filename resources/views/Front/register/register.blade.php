@extends('Front.layout.master_login_register_forgot', ['title' => 'Daftar Akun'])
@section('konten')
    <div class="wrapper">
        <div class="logo">
            <img src="{{ asset('Front/img/jakilat_logo.png') }}" alt="">
        </div>
        {{-- <div class="text-center mt-4">
            <p>Silahkan melakukan register sebagai Entreprenur</p>
        </div> --}}
        <div class="alert alert-danger d-flex align-items-center mt-4" style="border-radius: 1rem;" role="alert">
            <div>
                <p style="font-size: 0.8rem; margin-bottom: 0px !important;">Jika anda tidak menemukan nama lembaga pada
                    pilihan lembaga, segera hubungi lembaga tersebut untuk mendaftar</p>
            </div>
        </div>
        <form class="p-3 mt-3" id="form-daftar-pengguna">
            <div class="form-group">
                <div class="form-field d-flex align-items-center" style="margin-bottom: 0%;">
                    <span class="far fa-user"></span>
                    <input type="text" name="name" id="name" placeholder="Name">
                </div>
                <div class="input-group has-validation" style="margin-bottom: 20px; margin-top: 5px;">
                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                        class="text-danger error-text name_error"></label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-field d-flex align-items-center" style="margin-bottom: 0%;">
                    <span class="far fa-envelope"></span>
                    <input type="text" name="email" id="email" placeholder="Email">
                </div>
                <div class="input-group has-validation" style="margin-bottom: 20px; margin-top: 5px;">
                    <label style="margin-top: 0.1rem; font-size: 0.8rem; font-weight: 600;"
                        class="text-danger error-text email_error"></label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-field d-flex align-items-center" style="margin-bottom: 0%;">
                    <span class="far fa-building"></span>
                    <select name="lkp_id" id="register_pengguna">
                        <option value="" selected disabled>-- Pilih Lembaga --</option>
                        @foreach ($lkp as $data_lkp)
                            <option value="{{ $data_lkp->id }}">{{ $data_lkp->lkp }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group has-validation" style="margin-bottom: 20px; margin-top: 5px;">
                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                        class="text-danger error-text lkp_id_error"></label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-field d-flex align-items-center" style="margin-bottom: 0%;">
                    <span class="fas fa-key"></span>
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="input-group has-validation" style="margin-bottom: 20px; margin-top: 5px;">
                    <label style="margin-top: 0.2rem; font-size: 0.8rem; font-weight: 600;"
                        class="text-danger error-text password_error"></label>
                </div>
            </div>
            <button class="btn btn-primary ml-1" id="button-daftar-pengguna">
                <i id="icon-button-daftar-pengguna"></i>
                <span id="text-daftar-pengguna" class="d-none d-sm-block">
                    Daftar</span>
            </button>
        </form>
        <div class="text-center fs-6">
            Sudah memiliki akun? <a href="{{ route('Login') }}"><b>Login</b></a><br>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#register_pengguna").select2({
            theme: "bootstrap-5",
            dropdownParent: $("#register_pengguna").parent(), // Required for dropdown styling
        });


        if ($("#form-daftar-pengguna").length > 0) {
            $("#form-daftar-pengguna").validate({
                // rules: {
                //     email: {
                //         required: true,
                //         maxlength: 50,
                //     },
                //     password: {
                //         required: true,
                //         maxlength: 50,
                //     },
                //     lkp_id: {
                //         required: true
                //     }
                // },
                // messages: {
                //     email: {
                //         required: "<label class='text-danger error-text' style='margin-top:1.6rem !important; font-weight: 500; font-size: 0.7rem;'>Wajib diisi</label>",
                //         maxlength: "The email name should less than or equal to 50 characters",
                //     },
                //     password: {
                //         required: "<label class='text-danger error-text' style='margin-top:1.6rem !important; font-weight: 500; font-size: 0.7rem;'>Wajib diisi</label>",
                //         maxlength: "The email name should less than or equal to 50 characters",
                //     },
                //     lkp_id: {
                //         required: "<label class='text-danger error-text' style='margin-top:1.6rem !important; font-weight: 500; font-size: 0.7rem;'>Wajib diisi</label>",
                //     }

                // },
                submitHandler: function(form) {
                    var data = new FormData();
                    // Form data (Input yang ada di FORM, kecuali type file)
                    var $search = $("#icon-button-daftar-pengguna")
                    $("#icon-button-daftar-pengguna").addClass("fa fa-spinner fa-spin")
                    $("#text-daftar-pengguna").html('')
                    $("#button-daftar-pengguna").prop('disabled', true);
                    var form_data = $('#form-daftar-pengguna').serializeArray();
                    $.each(form_data, function(key, input) {
                        data.append(input.name, input.value);
                    });

                    //KASUS : Jika id tidak ditemukan maka ketika menekan tombol submit maka halaman akan reload
                    // data.append('pengguna_id', id);

                    //Custom data
                    data.append('key', 'value');

                    // AJAX request
                    $.ajax({
                        url: "{{ route('RegisterPengguna') }}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: data,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        beforeSend: function() {
                            $(document).find('label.error-text').text('');
                        },
                        success: function(data) {
                            if (data.status_form_kosong == 1) {
                                $.each(data.error, function(prefix, val) {
                                    $('label.' + prefix + '_error').text(val[
                                        0]);
                                    // $('span.'+prefix+'_error').text(val[0]);
                                });
                                $search.removeClass("fa fa-spinner fa-spin")
                                $("#text-daftar-pengguna").html(
                                    '<span id="text-daftar-pengguna" class="d-none d-sm-block">Daftar</span>'
                                )
                                $("#button-daftar-pengguna").prop('disabled', false);
                            } else if (data.status_berhasil_daftar == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave',
                                            Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'success',
                                    title: data.msg
                                })
                                window.location.href = `${data.route}`;
                                $search.removeClass("fa fa-spinner fa-spin")
                                $("#text-daftar-pengguna").html(
                                    '<span id="text-daftar-pengguna" class="d-none d-sm-block">Daftar</span>'
                                )
                            } else if (data.status_user_pass_salah == 1) {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave',
                                            Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: 'error',
                                    title: data.msg
                                })
                                $search.removeClass("fa fa-spinner fa-spin")
                                $("#text-daftar-pengguna").html(
                                    '<span id="text-daftar-pengguna" class="d-none d-sm-block">Daftar</span>'
                                )
                                $("#button-daftar-pengguna").prop('disabled', false);
                            }
                        }
                    });
                }
            })
        }
    </script>
@endsection

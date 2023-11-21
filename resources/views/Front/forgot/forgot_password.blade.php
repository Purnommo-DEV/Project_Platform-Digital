@extends('Front.layout.master_login_register_forgot', ['title' => 'Reset Password'])
@section('konten')
    <div class="wrapper">
        <div class="logo">
            <img src="{{ asset('Front/img/jakilat_logo.png') }}" alt="">
        </div>
        <div class="text-center mt-4">
            <p>Reset Password</p>
        </div>
        @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        <form action="{{ route('ForgotPasswordPost') }}" method="POST" class="p-3 mt-3">
            @csrf
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="email" id="email" placeholder="Email">
            </div>
            <button type="submit" class="btn mt-3">Kirim Link Reset Password</button>
        </form>
    </div>
@endsection
@section('script')
    <script>
        $("#register_pengguna").select2({
            theme: "bootstrap-5",
            dropdownParent: $("#register_pengguna").parent(), // Required for dropdown styling
        });


        if ($("#form-login-pengguna").length > 0) {
            $("#form-login-pengguna").validate({
                rules: {
                    email: {
                        required: true,
                        maxlength: 50,
                    },
                    password: {
                        required: true,
                        maxlength: 50,
                    },
                    lkp_id: {
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "<label class='text-danger error-text' style='margin-top:1.6rem !important; font-weight: 500; font-size: 0.7rem;'>Wajib diisi</label>",
                        maxlength: "The email name should less than or equal to 50 characters",
                    },
                    password: {
                        required: "<label class='text-danger error-text' style='margin-top:1.6rem !important; font-weight: 500; font-size: 0.7rem;'>Wajib diisi</label>",
                        maxlength: "The email name should less than or equal to 50 characters",
                    },
                    lkp_id: {
                        required: "<label class='text-danger error-text' style='margin-top:1.6rem !important; font-weight: 500; font-size: 0.7rem;'>Wajib diisi</label>",
                    }

                },
                submitHandler: function(form) {
                    var data = new FormData();
                    // Form data (Input yang ada di FORM, kecuali type file)
                    var form_data = $('#form-login-pengguna').serializeArray();
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
                            }
                        }
                    });
                }
            })
        }
    </script>
@endsection

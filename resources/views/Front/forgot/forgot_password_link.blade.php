<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* Importing fonts from Google */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

        /* Reseting */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #ecf0f3;
        }

        .wrapper {
            max-width: 350px;
            min-height: 500px;
            margin: 80px auto;
            padding: 40px 30px 30px 30px;
            background-color: #ecf0f3;
            border-radius: 15px;
            box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
        }

        .logo {
            width: 80px;
            margin: auto;
        }

        .logo img {
            width: 100%;
            height: 80px;
            object-fit: contain;
            border-radius: 50%;
            box-shadow: 0px 0px 3px #5f5f5f,
                0px 0px 0px 5px #ecf0f3,
                8px 8px 15px #a7aaa7,
                -8px -8px 15px #fff;
        }

        .wrapper .name {
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: 1.3px;
            padding-left: 10px;
            color: #555;
        }

        .wrapper .form-field input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1.2rem;
            color: #666;
            padding: 10px 15px 10px 10px;
            /* border: 1px solid red; */
        }

        .wrapper .form-field {
            padding-left: 10px;
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
        }

        .wrapper .form-field .fas {
            color: #555;
        }

        .wrapper .btn {
            box-shadow: none;
            width: 100%;
            height: 40px;
            background-color: #03A9F4;
            color: #fff;
            border-radius: 25px;
            box-shadow: 3px 3px 3px #b1b1b1,
                -3px -3px 3px #fff;
            letter-spacing: 1.3px;
        }

        .wrapper .btn:hover {
            background-color: #039BE5;
        }

        .wrapper a {
            text-decoration: none;
            font-size: 0.8rem;
            color: #03A9F4;
        }

        .wrapper a:hover {
            color: #039BE5;
        }

        @media(max-width: 380px) {
            .wrapper {
                margin: 30px 20px;
                padding: 40px 15px 15px 15px;
            }
        }
    </style>
</head>

<body class="antialiased">
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
        <form action="{{ route('reset.password.post') }}" method="POST" class="p-3 mt-3">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="text" name="email" id="email" placeholder="Email">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="password" name="password" id="password" placeholder="Password baru">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="password" name="konfirmasi_password" id="konfirmasi_password"
                    placeholder="Konfirmasi Password Baru">
                @if ($errors->has('konfirmasi_password'))
                    <span class="text-danger">{{ $errors->first('konfirmasi_password') }}</span>
                @endif
            </div>
            <button type="submit" class="btn mt-3">Reset Password</button>
        </form>
        {{-- <div class="text-center fs-6">
            <a href="#">Forget password?</a> or <a href="#">Sign up</a>
        </div> --}}
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('All/js/form/jquery.form.min.js') }}"></script>
<script src="{{ asset('All/js/validate/jquery.validate.min.js') }}"></script>

<script src="{{ asset('All/js/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('All/js/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script>
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
                    url: "{{ route('LoginPengguna') }}",
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
                        } else if (data.status_berhasil_login == 1) {
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

</html>

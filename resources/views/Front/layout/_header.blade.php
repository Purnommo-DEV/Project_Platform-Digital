<header>
    <!-- Start Navigation -->
    <nav class="navbar mobile-sidenav navbar-sticky navbar-default validnavs navbar-fixed white no-background">

        <!-- Start Top Search -->
        <div class="top-search">
            <div class="container-xl">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                </div>
            </div>
        </div>
        <!-- End Top Search -->

        <div class="container d-flex justify-content-between align-items-center">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                {{-- <button class="navbar-toggle">
                    <a href="{{ route('HalamanBeranda') }}">
                        <i class="far fa-home"></i>
                    </a>
                </button> --}}
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ route('HalamanBeranda') }}">
                    <img src="{{ asset('Front/img/jakilat_logo_light.png') }}" class="logo logo-display" alt="Logo">
                    <img src="{{ asset('Front/img/jakilat_logo.png') }}" class="logo logo-scrolled" alt="Logo">
                </a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">
                <img src="{{ asset('Front/img/jakilat_logo.png') }}" alt="Logo">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                    <i class="fa fa-times"></i>
                </button>
                <ul class="nav navbar-nav navbar-center" data-in="fadeInDown" data-out="fadeOutUp">
                    <li><a href="{{ route('HalamanBeranda') }}"><i class="far fa-home"></i></a></li>
                    @if (request()->routeIs('HalamanBeranda'))
                        @auth
                            @if (Auth::user()->role_id == 1)
                                <li><a href="{{ route('admin.HalamanDashboard') }}">Dashboard</a></li>
                            @elseif (Auth::user()->role_id == 2)
                                <li><a href="{{ route('lembaga.HalamanInformasiPengguna') }}">Informasi Lembaga</a></li>
                            @elseif (Auth::user()->role_id == 3)
                                <li><a href="{{ route('entrepreneur.HalamanInformasiPenggunaEntrepreneur') }}">Informasi
                                        Siswa</a></li>
                            @endif
                        @endauth
                        @guest
                            <li><a href="{{ route('Login') }}">Login</a></li>
                            <li><a href="{{ route('Register') }}">Daftar Siswa</a></li>
                            <li><a href="https://wa.me/6281251174782?text=Halo%20nama%20saya%20nadine">Daftar Lembaga</a>
                            </li>
                        @endguest
                    @endif
                </ul>
            </div>


            {{-- <div class="attr-right">
                <div class="attr-nav">
                    <ul>
                        <li>
                            <a href="{{ route('HalamanBeranda') }}">
                                <i class="far fa-home"></i>
                            </a>
                        </li>
                        <li class="side-menu">
                            <a href="#">
                                <span class="bar-1"></span>
                                <span class="bar-2"></span>
                                <span class="bar-3"></span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="side">
                    <a href="#" class="close-side"><i class="icon_close"></i></a>
                    <div class="widget">
                        <div class="logo">
                            <img src="assets/img/logo-light.png" alt="Logo">
                        </div>
                        <p>
                            Arrived compass prepare an on as. Reasonable particular on my it in sympathize. Size now
                            easy eat hand how. Unwilling he departure elsewhere dejection at. Heart large seems may
                            purse means few blind.
                        </p>
                    </div>
                    <div class="widget address">
                        <div>
                            <ul>
                                <li>
                                    <div class="content">
                                        <p>Address</p>
                                        <strong>California, TX 70240</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="content">
                                        <p>Email</p>
                                        <strong>support@validtheme.com</strong>
                                    </div>
                                </li>
                                <li>
                                    <div class="content">
                                        <p>Contact</p>
                                        <strong>+44-20-7328-4499</strong>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget newsletter">
                        <h4 class="title">Get Subscribed!</h4>
                        <form action="#">
                            <div class="input-group stylish-input-group">
                                <input type="email" placeholder="Enter your e-mail" class="form-control"
                                    name="email">
                                <span class="input-group-addon">
                                    <button type="submit">
                                        <i class="arrow_right"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="widget social">
                        <ul class="link">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-behance"></i></a></li>
                        </ul>
                    </div>

                </div>
            </div> --}}
        </div>

        <!-- Overlay screen for menu -->
        <div class="overlay-screen"></div>
        <!-- End Overlay screen for menu -->

    </nav>
    <!-- End Navigation -->
</header>

<!DOCTYPE html>
<html lang="en">
@include('Front.layout._head')

<body>

    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Start Preloader
    ============================================= -->
    <div id="preloader">
        <div id="ambrox-preloader" class="ambrox-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    <span data-text-preloader="J" class="letters-loading">
                        J
                    </span>
                    <span data-text-preloader="A" class="letters-loading">
                        A
                    </span>
                    <span data-text-preloader="K" class="letters-loading">
                        K
                    </span>
                    <span data-text-preloader="I" class="letters-loading">
                        I
                    </span>
                    <span data-text-preloader="L" class="letters-loading">
                        L
                    </span>
                    <span data-text-preloader="A" class="letters-loading">
                        A
                    </span>
                    <span data-text-preloader="T" class="letters-loading">
                        T
                    </span>
                </div>
            </div>
            <div class="loader">
                <div class="row">
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-left">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                    <div class="col-3 loader-section section-right">
                        <div class="bg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->

    <!-- Header
    ============================================= -->
    @if (request()->routeIs('SKJakilat'))
    @else
        @include('Front.layout._header')
    @endif
    <!-- End Header -->

    <!-- Start Banner Area
    ============================================= -->
    <div class="banner-style-three-area text-center bg-cover text-light"
        style="background-image: url({{ 'Front/img/shape/36.png' }});">

        <div class="animate-shape">
            <img src="{{ asset('Front/img/illustration/cloud.png') }}" alt="Image not found">
            <img src="{{ asset('Front/img/illustration/cloud2.png') }}" alt="Image not found">
        </div>

        <!-- Single Item -->
        @if (request()->routeIs('HalamanBeranda'))
            <div class="banner-style-three">
                <div class="container">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="info">
                                    <h4>Platform Digital</h4>
                                    <h2>Perluas Jangkauan Berikan Kemudahan</h2>
                                    <div class="button mt-40">
                                        <a href="{{ route('SKJakilat') }}" {{-- class="popup-youtube video-play-button optional light with-text" --}}
                                            class="video-play-button optional light with-text" target="_blank">
                                            <div class="effect"></div>
                                            <span><i class="fas fa-play"></i>Ayo Bergabung</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8 offset-lg-2">
                                <div class="thumb">
                                    <img src="{{ asset('Front/img/illustration/24.png') }}" alt="Thumb">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="shape-bottom-center" style="background-image: url({{ 'Front/img/shape/5.png' }});"></div>
                <div class="shape-top-right" style="background-image: url({{ 'Front/img/shape/6.png' }});"></div>
                <div class="shape-left-top" style="background-image: url({{ 'Front/img/shape/7.png' }});"></div>
            </div>
        @endif
        <!-- End Single Item -->
    </div>
    <!-- End Banner -->

    @yield('konten')
    @include('Front.layout._footer')

    @include('Front.layout._script')
    @stack('script')
</body>

</html>

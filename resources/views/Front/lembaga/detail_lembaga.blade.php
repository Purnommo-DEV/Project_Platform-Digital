@extends('Front.layout.master', ['title' => 'Detail Lembaga'])
@section('konten')
    <div class="banner-area banner-business text-center navigation-circle zoom-effect overflow-hidden text-light">
        <!-- Slider main container -->
        <div class="banner-fade">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">

                <!-- Single Item -->
                <div class="swiper-slide banner-style-business">
                    <div class="banner-thumb bg-cover" style="background: url({{ asset('Front/img/2440x1578.png') }});"></div>
                    <div class="container">
                        <div class="row align-center">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="content">
                                    <h4>Meet Consulting</h4>
                                    <h2><strong>Financial Analysis</strong> Developing Meeting.</h2>
                                    <div class="button">
                                        <a class="btn btn-md btn-light animation" href="contact-us.html">Get in touch</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- End Single Item -->

                <!-- Single Item -->
                <div class="swiper-slide banner-style-business">
                    <div class="banner-thumb bg-cover" style="background: url({{ asset('Front/img/2440x1578.png') }});">
                    </div>
                    <div class="container">
                        <div class="row align-center">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="content">
                                    <h4>Coaching & Consulting</h4>
                                    <h2><strong>Strategies for</strong> Enduring Success</h2>
                                    <div class="button">
                                        <a class="btn btn-md btn-light animation" href="contact-us.html">Get in touch</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Shape -->
                    <div class="banner-shape-bg">
                        <img src="assets/img/shape/banner-1.png" alt="Shape">
                    </div>
                    <!-- End Shape -->
                </div>
                <!-- End Single Item -->

            </div>

            <!-- Navigation -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

        </div>
    </div>

    <div class="team-style-one-area text-center default-padding bottom-less">

        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4 class="sub-title">Team members</h4>
                        <h2 class="title">Expert Team Members</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row align-center">

                <div class="col-lg-12">
                    <div class="row d-flex justify-content-center">
                        <!-- Single Item -->
                        @foreach ($lkp as $data_lkp)
                            <div class="team-style-one col-xl-3 col-lg-6 col-md-6">
                                <div class="team-style-one-item"
                                    style="background-image: url({{ asset('Front/img/shape/11.png') }});">
                                    <div class="thumb">
                                        <img src="{{ asset('storage/' . $data_lkp->path) }}" alt="Image not found"
                                            style="aspect-ratio: 2/2;">
                                    </div>
                                    <div class="info">
                                        <h4><a
                                                href="{{ route('HalamanDetailLKP', $data_lkp->slug) }}">{{ $data_lkp->lkp }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- End Single Item -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

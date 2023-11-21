@extends('Front.layout.master', ['title' => 'Detail Entrepreneur'])
@section('konten')
    <div class="boosting-area mt-4 text-light">
        <div class="container">
            <div class="boosting-items bg-dark" style="background-image: url({{ asset('Front/img/shape/37.png') }});">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-5">
                        <div class="boosting-style-one-thumb mb-md-60 mb-xs-40">
                            <img class="card-img-top wow fadeInLeft"
                                src="{{ asset('storage/' . $entrepreneur_detail->path) }}" alt="Image not found"
                                style="aspect-ratio: 2/2; border-radius: 1rem;">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="boosting-style-one">
                            <h4 class="sub-title">{{ $entrepreneur_detail->kategori }}</h4>
                            <p><i class="far fa-city"></i>&nbsp;&nbsp;{{ $entrepreneur_detail->relasi_kota->kota ?? '' }}
                            </p>
                            <h2 class="title">{{ $entrepreneur_detail->relasi_user->name }}</h2>
                            <p>
                                {{ $entrepreneur_detail->deskripsi }}
                            </p>
                            <ul class="shor-contact">
                                <li>
                                    @foreach ($sosmed_pengguna as $sosmed)
                                        <div class="icon" style="padding-right: 0.6rem;">
                                            <a href="{{ $sosmed->link_sosmed }}" target="_blank"><i
                                                    class="fab fa-{{ $sosmed->sosmed }}"
                                                    style="display: inline-block;
                                                width: 40px;
                                                line-height: 43px;
                                                text-align: center;
                                                border: 1px solid rgba(255, 255, 255, 0.3);
                                                border-radius: 5px;
                                                font-size: 25px;
                                                color: #ffffff;
                                                min-width: 0 !important;"></i></a>
                                        </div>
                                    @endforeach
                                </li>
                            </ul>
                            <ul class="shor-contact">
                                <li>
                                    <div class="icon" style="padding-right: 0.6rem;">
                                        <a class="btn btn-sm btn-primary copy_text"
                                            style="font-weight: 500!important; padding: 5px!important; background: #ffffff;
                                        color: #000000;"
                                            href="{{ route('HalamanDetailLKP', $entrepreneur_detail->slug) }}">Share
                                            Link</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="project-area default-padding" style="background-image: url({{ asset('Front/img/shape/1.png') }});">
        <!-- Shape -->
        <div class="shape-right-top" style="background-image: url({{ asset('Front/img/shape/22.png') }});"></div>
        <!-- End Shape -->
        <div class="container" style="margin-bottom: -3rem;">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4 class="sub-title">{{ $entrepreneur_detail->relasi_lkp->lkp }}</h4>
                        <h2 class="title">Promosi</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="projects-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="project-carousel swiper">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Single Item -->
                                @forelse ($iklan_lkp as $iklan)
                                    <div class="swiper-slide">
                                        <div class="project-style-one">
                                            <div class="thumb">
                                                <a href="{{ asset('storage/' . $iklan->path) }}?image={{ $iklan->id }}"
                                                    data-toggle="lightbox" data-gallery="iklan" class="col-sm-4">
                                                    <img src="{{ asset('storage/' . $iklan->path) }}?image={{ $iklan->id }}"
                                                        class="card-img-top" style="aspect-ratio: 3/2; height: 300px;">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse

                            </div>

                            <div class="swiper-control">
                                <!-- Pagination -->
                                <div class="swiper-pagination"></div>

                                <!-- Navigation -->
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="blog-area blog-grid"
        style="padding-bottom: 5rem; background-image: url({{ asset('Front/img/shape/28.png') }});">
        <div class="container" style="margin-bottom: -1rem; margin-top: 2rem;">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4 class="sub-title">Jelajahi</h4>
                        <h2 class="title" style="font-size: 50px">Produk</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <!-- Single item -->
                @foreach ($produk_pengguna as $produk)
                    <div class="col-xl-3 col-md-4 mb-4">
                        <div class="item">
                            <div class="thumb">
                                <a href="{{ asset('storage/' . $produk->path) }}?image={{ $produk->id }}"
                                    data-toggle="lightbox" data-gallery="produk" class="col-sm-4">
                                    <img src="{{ asset('storage/' . $produk->path) }}?image={{ $produk->id }}"
                                        class="card-img-top" style="aspect-ratio: 1/1;">
                                </a>
                                <div class="tags">
                                    <a href="#">{{ $produk->nama_gambar }}</a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $('.copy_text').click(function(e) {
            e.preventDefault();
            var copyText = $(this).attr('href');

            document.addEventListener('copy', function(e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);
            document.execCommand('copy');
            Swal.fire('Link Berhasil di Copy')
        });
    </script>
@endpush

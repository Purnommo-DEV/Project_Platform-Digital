@extends('Front.layout.master', ['title' => 'Beranda'])
@section('konten')
    <div class="services-style-two-area default-padding bottom-less relative"
        style="background-image:linear-gradient(to bottom, rgb(255 255 255) 20%, rgb(243 243 243 / 0%) 36%, rgb(255 255 255 / 55%) 100%), url({{ asset('Front/img/shape/banner-3.jpg') }});">
        <div class="container" style="margin-bottom: -3rem;">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="site-heading text-center">
                        <h4 class="sub-title">Kami Memberikan</h4>
                        <h2 class="title">Layanan Platform</h2>
                        <div class="devider"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="why-seo-box">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-10 pl-60 pl-md-15 pl-xs-15 services-style-two">

                        <div class="seo-carousel swiper">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">

                                <!-- Single item -->
                                <div class="swiper-slide">

                                    <div class="item">
                                        <i class="flaticon-bullhorn"></i>
                                        <h4><a href="#!">Promosikan Portfolio</a></h4>
                                        <p>
                                            Miliki link website portfolio secara gratis dan bagikan kepada siapapun dengan
                                            mudah.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->

                                <!-- Single item -->
                                <div class="swiper-slide">

                                    <div class="item">
                                        <i class="flaticon-resume"></i>
                                        <h4><a href="#!">Perkenalkan Produk</a></h4>
                                        <p>
                                            Perkenalkan dan kembangkan produk maupun jasa hanya dalam satu platform.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->

                                <!-- Single item -->
                                <div class="swiper-slide">

                                    <div class="item">
                                        <i class="flaticon-data-analysis-1"></i>
                                        <h4><a href="#!">Tingkatkan Bisnis</a></h4>
                                        <p>
                                            Produk lebih mudah dijangkau dan dipublikasikan kepada khalayak luas.
                                        </p>
                                    </div>
                                </div>
                                <!-- End Single Item -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="testimonial-style-two-area overflow-hidden relative pt-150 pt-xs-80 pb-120 pb-xs-60 bg-gradient">
        <div class="curve-top">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#f3f7fd">
                <path
                    d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z">
                </path>
            </svg>
        </div>

        <div class="shape-animation">
            {{-- <img src="assets/img/shape/anim-1.png" alt="Image Not Found"> --}}
        </div>
        <div class="container">
            <div class="row align-center">
                <div class="testimonial-style-two text-light col-xl-4 col-lg-5">
                    <h4 class="sub-heading">Tentang Kami</h4>
                    <h2 class="heading">Promosikan Produk UMKM & Wirausaha di Platform kami</h2>
                    <div class="rating-provider">
                        <p>
                            Website yang memberikan informasi lembaga pendidikan dan mempromosikan produk yang dihasilkan
                            oleh siswa agar mempunyai hala,man portofolio website gratis yang secara khusus fokus pada
                            Produk UMKM & Wirausaha .
                        </p>
                    </div>
                </div>
                <div class="testimonial-style-two pl-65 pl-md-15 pl-xs-15 col-xl-8 col-lg-7">

                    <div class="testimonial-style-one-carousel swiper">
                        <!-- Additional required wrapper -->
                        <img src="{{ asset('Front/img/illustration/15.png') }}" alt="Image Not Found">
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="blog-area blog-grid default-padding bottom-less"
        style="background-image: url({{ asset('Front/img/shape/28.png') }});">
        <div class="seo-score-area">
            <div class="container">
                <div class="seo-score">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2 form text-center">
                            <h2 class="mb-40">
                                Temukan Mitra Kami Dan Hubungi
                                <strong>Secara Gratis</strong>
                            </h2>
                            <h5 class="sub-title">Pilih Pencarian
                            </h5>
                            <div class="row justify-content-md-center" style="margin-bottom: 1rem;">
                                <div class="col-md-3" style="padding: 2px;">
                                    <div class="form-group">
                                        <button class="btn pilih-lembaga"
                                            style="padding:10px 40px !important;border-radius: 20px;">Lembaga</button>
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding: 2px;">
                                    <div class="form-group">
                                        <button class="btn pilih-entrepreneur"
                                            style="padding:10px 40px !important;border-radius: 20px;">Entrepreneur</button>
                                    </div>
                                </div>
                            </div>
                            <form action="#" id="formPencarian">
                                @csrf
                                <div class="input">
                                    <div class="form-group">
                                        <input type="hidden" name="mitra_id" id="mitra_id" hidden>
                                        <input class="form-control" id='search' {{-- id="cari-mitra" --}}
                                            placeholder="Masukkan Pencarian" type="text">
                                    </div>
                                </div>
                                {{-- <button type="submit">Cari</button> --}}
                            </form>
                        </div>
                    </div>
                    <div class="auto-load text-center" style="display: none;">
                        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="60" viewBox="0 0 100 100"
                            enable-background="new 0 0 0 0" xml:space="preserve">
                            <path fill="#000"
                                d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                <animateTransform attributeName="transform" attributeType="XML" type="rotate"
                                    dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                            </path>
                        </svg>
                    </div>
                    @include('Front.beranda.lkp')
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#search').keyup(function() {
                // Search text
                var text = $(this).val();

                // Hide all content class element
                $('.single-item').hide();

                // Search and show
                $('.single-item .item .info .nama-lkp:contains("' + text + '")').closest('.single-item')
                    .show();
                // $('.single-item .item .thumb .tags:contains("' + text + '")').closest('.single-item')
                //     .show();

            });
        });
        $.expr[":"].contains = $.expr.createPseudo(function(arg) {
            return function(elem) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });

        $("#cari-mitra").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('Pencarian') }}",
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#cari-mitra').val(ui.item.label);
                $('#mitra_id').val(ui.item.id);
                // Output :
                // {value: 'PHP Laravel Web Development', id: '2ce0335400bc4fa4956fe64dfe194aa7', label: 'PHP Laravel Web Development'}
                return false;
            }
        });

        $('#formPencarian').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('HasilPencarian') }}",
                method: "POST",
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                cache: false,
                beforeSend: function() {
                    $('.auto-load').show();
                    $('.class-mitra-data').hide();
                },
                success: function(response) {
                    if (response.status_tidak_ditemukan == 1) {
                        let post = `
                        <div class="row d-flex justify-content-center class-mitra-data" id="mitra_data_id"
                                style="margin-bottom: 5rem;margin-top: 2rem;">
                                <div class="single-item col-lg-3 col-md-8">
                                    <div class="thumb">
                                        <img src="{{ asset('All/img/no-data.jpg') }}" class="card-img-top" alt="Image not found"
                                            style="aspect-ratio: 2/2;">
                                    </div>
                                    <div class="info">
                                        <h4>
                                        </h4>
                                    </div>
                                </div>
                            </div>`
                        $('.auto-load').hide();
                        $('#mitra_data_id').replaceWith(post);
                        // infinteLoadMore()
                    } else if (response.status_ditemukan == 1) {
                        let post =

                            //     <div class="row d-flex justify-content-center" id="mitra_data_id"
                            //     style="margin-bottom: 5rem;margin-top: 2rem;">
                            //     <div class="single-item col-lg-3 col-md-8">
                            //             <div class="team-style-one-item"
                            //                 style="background-image: url({{ asset('Front/img/shape/11.png') }});">

                            //                 <div class="thumb">
                            //                     <img src="/storage/${response.data.path}" class="card-img-top"
                            //                         alt="Image not found" style="aspect-ratio: 2/2;">
                            //                 </div>
                            //                 <div class="info">
                            //                     <h4><a
                            //                             href="/detail-lkp/${response.data.slug}">${response.data.lkp}</a>
                            //                     </h4>
                            //                     <span>${response.data.relasi_kategori.kategori}</span>
                            //                 </div>
                            //             </div>
                            //         </div>
                            //         <a class="btn btn-sm btn-primary tampilkan_semua"
                            //         style="font-weight: 500!important; padding: 5px!important; background: #ffffff;
                            // color: #000000;">Tampilkan Semua</a>
                            //         </div>;

                            `
                        <div class="row d-flex justify-content-center class-mitra-data" id="mitra_data_id" style="margin-bottom: 5rem;margin-top: 2rem;">
                            <div class="col-lg-3 col-md-8 single-item">
                                <div class="item h-100">
                                    <div class="thumb">
                                        <a href="/detail-lkp/${response.data.slug}">
                                            <img src="/storage/${response.data.path}" class="card-img-top" alt="Image not found"
                                                style="aspect-ratio: 2/2;">
                                        </a>
                                        <div class="tags">
                                            <a href="#">${response.data.relasi_kategori.kategori}</a>
                                        </div>
                                    </div>
                                    <div class="info h-100">
                                        <div class="meta">
                                            <ul>
                                                <li>
                                                    <a href="/detail-lkp/${response.data.slug}"><i class="far fa-city"></i>
                                                        ${response.data.relasi_kota.kota}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <h5>
                                            <a href="/detail-lkp/${response.data.slug}">${response.data.lkp}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-sm btn-primary tampilkan_semua"
                                    style="font-weight: 500!important; padding: 5px!important; background: #ffffff;
                            color: #000000;">Tampilkan Semua</a>
                        </div>`;



                        //append to post data
                        $('.auto-load').hide();
                        $('#mitra_id').val('');
                        $('#mitra_data_id').replaceWith(post);
                    }
                },
            });
        });

        $(document).on('click', '.tampilkan_semua, .pilih-lembaga', function(event) {
            infinteLoadMore()
        });

        function infinteLoadMore() {
            $.ajax({
                    url: "{{ route('TampilDataSemuaLKP') }}",
                    datatype: "html",
                    type: "get",
                    beforeSend: function() {
                        $('.auto-load').show();
                        $('.class-mitra-data').hide();
                    }
                })
                .done(function(response) {
                    $('.auto-load').hide();
                    $('#mitra_data_id').replaceWith(response.html);
                    $('#cari-mitra').val('');
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        }

        $(document).on('click', '.pilih-entrepreneur', function(event) {
            $.ajax({
                    url: "{{ route('TampilDataSemuaEntrepreneur') }}",
                    datatype: "html",
                    type: "get",
                    beforeSend: function() {
                        $('.auto-load').show();
                        $('.class-mitra-data').hide();
                    }
                })
                .done(function(response) {
                    $('.auto-load').hide();
                    $('#mitra_data_id').replaceWith(response.html);
                    $('#cari-mitra').val('');
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('Server error occured');
                });
        });
    </script>
@endpush

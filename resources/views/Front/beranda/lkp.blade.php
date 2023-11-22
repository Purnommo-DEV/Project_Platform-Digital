{{-- <div class="row d-flex justify-content-center class-mitra-data" id="mitra_data_id"
    style="margin-bottom: 5rem;margin-top: 2rem;">

    @foreach ($lkp as $data_lkp)
        @php
            $transaksi = \App\Models\Transaksi::where('users_id', $data_lkp->users_id)
                ->where('status_id', 1)
                ->first();
        @endphp
        @empty($transaksi)
        @else
            <div class="single-item col-lg-3 col-md-8">
                <div class="team-style-one-item" style="background-image: url({{ asset('Front/img/shape/11.png') }});">

                    <div class="thumb">
                        <img src="{{ asset('storage/' . $data_lkp->path) }}" class="card-img-top" alt="Image not found"
                            style="aspect-ratio: 2/2;">
                    </div>
                    <div class="info">
                        <span>{{ $data_lkp->relasi_kota->kota ?? '' }}</span>
                        <h4><a href="{{ route('HalamanDetailLKP', $data_lkp->slug) }}">{{ $data_lkp->lkp }}</a>
                        </h4>
                        <span>{{ $data_lkp->kategori ?? '' }}</span>
                    </div>
                </div>
            </div>
        @endempty
    @endforeach

</div> --}}

{{--
<div class="row d-flex justify-content-center class-mitra-data" id="mitra_data_id"
    style="margin-bottom: 5rem;margin-top: 2rem;">
    @foreach ($lkp as $data_lkp)
        <div class="col-lg-3 col-md-8 single-item">
            <div class="item h-100">
                <div class="thumb">
                    <a href="{{ route('HalamanDetailLKP', $data_lkp->slug) }}">
                        @if ($data_lkp->path == null)
                            <img src="/All/img/no_image.jpg" style="aspect-ratio: 2/2;">
                        @else
                            <img src="{{ asset('storage/' . $data_lkp->path) }}" class="card-img-top"
                                alt="Image not found" style="aspect-ratio: 2/2;">
                        @endif
                    </a>
                </div>
                <div class="info h-100">
                    <div class="meta">
                        <ul>
                            <li>
                                <a href="{{ route('HalamanDetailLKP', $data_lkp->slug) }}"><i class="far fa-city"></i>
                                    {{ $data_lkp->relasi_kota->kota ?? '' }}</a>
                            </li>
                        </ul>
                    </div>
                    <h5 class="nama-lkp">
                        <a href="{{ route('HalamanDetailLKP', $data_lkp->slug) }}">{{ $data_lkp->lkp }}</a>
                    </h5>
                </div>
            </div>
        </div>
    @endforeach
</div> --}}


<div class="games-soon">
    <div class="row d-flex justify-content-center class-mitra-data" id="mitra_data_id"
        style="margin-bottom: 5rem;margin-top: 2rem;">
        <div class="col-lg-12">
            <div class="products">
                <div class="row justify-content-center">
                    @forelse ($lkp as $data_lkp)
                        <div class="col-6 col-md-3 single-item"
                            style="padding-left: 0% !important; padding-right: 0% !important; padding: 4px !important;">
                            <div class="item h-100">
                                <div class="product">
                                    <div class="thumb">
                                        <a href="{{ route('HalamanDetailLKP', $data_lkp->slug) }}">
                                            @if ($data_lkp->path == null)
                                                <img src="/All/img/no_image.jpg" style="aspect-ratio: 2/2;">
                                            @else
                                                <img src="{{ asset('storage/' . $data_lkp->path) }}"
                                                    class="card-img-top wow fadeInLeft" alt="Image not found"
                                                    style="aspect-ratio: 2/2;">
                                            @endif
                                        </a>
                                    </div>

                                    <div class="product-body">
                                        <div class="info h-100">
                                            <div class="meta">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('HalamanDetailLKP', $data_lkp->slug) }}"><i
                                                                class="far fa-city"></i>
                                                            {{ $data_lkp->relasi_kota->kota ?? '' }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <h5 class="nama-lkp">
                                                <a
                                                    href="{{ route('HalamanDetailLKP', $data_lkp->slug) }}">{{ $data_lkp->lkp }}</a>
                                            </h5>
                                        </div>
                                    </div><!-- End .product-body -->
                                </div><!-- End .product -->
                            </div>
                        </div><!-- End .col-sm-6 col-md-4 -->
                    @empty
                        <div class="row d-flex justify-content-center class-mitra-data" id="mitra_data_id"
                            style="margin-bottom: 5rem;margin-top: 2rem;">
                            <div class="single-item col-lg-3 col-md-8">
                                <div class="thumb">
                                    <img src="{{ asset('All/img/no-data.jpg') }}" class="card-img-top"
                                        style="aspect-ratio: 2/2;">
                                </div>
                                <div class="info">
                                    <h4>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div><!-- End .row -->
            </div><!-- End .products -->
        </div><!-- End .col-lg-7 -->
    </div><!-- End .row -->
</div>

@extends('Back.layout.master', ['title' => 'Detail Lembaga Kursus dan Pelatihan'])
@section('konten-admin')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15);">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="pr-50">
                                    <img class="w-100" src="{{ asset('storage/' . $data_lkp->path) }}"
                                        alt="avtar img holder">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="media-body">
                                    <div class="user-details">
                                        <div class="mail-items">
                                            <span class="list-group-item-text text-truncate">{{ $data_lkp->lkp }}</span>
                                        </div>
                                    </div>
                                    <div class="mail-message">
                                        <p class="list-group-item-text truncate mb-0">
                                            {{ $data_lkp->deskripsi }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15);">
                            <div class="card-body">
                                @include('Back.Lembaga.lkp._lkp_sosmed')
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15);">
                            <div class="card-body">
                                @include('Back.Lembaga.lkp._lkp_iklan')
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="card" style="box-shadow:0 0 7px 0 rgba(30,5,0,0.15);">
                            <div class="card-body">
                                @include('Back.Lembaga.lkp._lkp_gambar_produk')
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
        $('#form-EditDataLembaga').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(document).find('label.error-text').text('');
                },
                success: function(data) {
                    if (data.status == 0) {
                        $.each(data.error, function(prefix, val) {
                            $('label.' + prefix + '_error').text(val[0]);
                            // $('span.'+prefix+'_error').text(val[0]);
                        });
                    } else if (data.status == 1) {
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
                        $("#informasi").load(location.href +
                            " #informasi>*", "");
                    }
                }
            });
        });
    </script>
@endsection

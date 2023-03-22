@extends('frontend.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Rental Mobil | Detail</title>
@endpush

@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Konfirmasi Pembayaran</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="#">Home</a></li>
                        <li class="active">konfirmasi-pembayaran</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- Order Details -->
                <div class="col-md-5 col-sm-offset-3  order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Rekening Pembayaran</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-products">
                            <div class="order-col">
                                <div>Nama </div>
                                <div>{{ $dataRekening->nama_rek }}</div>
                            </div>
                            <div class="order-col">
                                <div>Bank</div>
                                <div>{{ $dataRekening->jenis_bank }}</div>
                            </div>
                        </div>
                        <div class="order-col">
                            <div>No Rekening</div>
                            <div>{{ $dataRekening->no_rek }}</div>
                        </div>
                    </div>
                    <hr>
                    <div class="section-title text-center">
                        <h3 class="title">Detail Rental</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>PRODUCT</strong></div>
                            <div><strong>KETERANGAN</strong></div>
                        </div>
                        <div class="order-products">
                            <div class="order-col">
                                <div>Nama Kendaraan</div>
                                <div>{{ $data->nama_mobil }}</div>
                            </div>
                            <div class="order-col">
                                <div>Merk Kendaraan</div>
                                <div>{{ $data->merk_mobil }}</div>
                            </div>
                        </div>
                        <div class="order-col">
                            <div>Warna Kendaraan</div>
                            <div>{{ $data->warna }}</div>
                        </div>
                        <div class="order-col">
                            <div>Tahun Kendaraan</div>
                            <div>{{ substr($data->th_mobil, 0, 4) }}</div>
                        </div>
                        <div class="order-col">
                            <div>Tgl Rental</div>
                            <div>{{ $data->tgl_rental }}</div>
                        </div>
                        <div class="order-col">
                            <div>Tgl Kembali</div>
                            <div>{{ $data->tgl_kembali }}</div>
                        </div>
                        <div class="order-col">
                            <div>Harga Sewa</div>
                            <div>Rp. {{ number_format($data->harga_sewa) }} /Hari</div>
                        </div>
                        <div class="order-col">
                            <div>Lama Sewa</div>
                            <div>{{ $data->lama_sewa }} Hari</div>
                        </div>
                        <div class="order-col">
                            <div><strong>TOTAL</strong></div>
                            <div><strong class="order-total">Rp. {{ number_format($data->total_biaya) }}</strong></div>
                        </div>
                    </div>
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment-1">
                            <label for="payment-1">
                                <span></span>
                                Transfer Bank
                            </label>
                            <div class="caption">
                                <p>Silahkan lakukan pembayaran sesuai dengan total pembayaran ke no rekening yang tertera di
                                    atas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="terms">
                        <label for="terms">
                            <span></span>
                            Saya telah membaca dan menerima <a href="#">syarat & ketentuan</a>
                        </label>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#uploadbuktipembayaran"
                        class="primary-btn order-submit">Upload Bukti Pembayaran</a>
                </div>
                <!-- /Order Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
    <div class="modal fade" id="uploadbuktipembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="image-upload" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" value="{{ $dataRekening->id_rek }}" name="id_rek">
                        <input type="hidden" id="id_tuser" name="id_tuser" value="{{ $data->id_tuser }}">
                        <input type="hidden" id="id_rental" name="id_rental" value="{{ $data->id_rental }}">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tgl Pembayaran:</label>
                            <input type="date" disabled class="form-control" name="tgl_pembayaran" id="tgl_pembayaran"
                                value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Upload Bukti Pembayaran</label>
                            <input type="file" class="form-control" name="image" id="image"
                                accept="image/png, image/gif, image/jpeg" onchange="previewFile(this);">
                        </div>
                        <div class="holder">
                            <img id="imgPreview" style="width: 100%; height: 400px"
                                src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="pic" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
            },
        });

        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function() {
                    $("#imgPreview").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }

        $('#image-upload').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('pembayarangAdd') }}",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response.success);
                    if (response.success === true) {
                        $('#uploadbuktipembayaran').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Konfirmasi pembayaran berhasil dilakukan',
                            timer: 1500
                        });
                    }
                },
                error: function(err) {
                    console.log(err.responseJSON.message);
                    Swal.fire({
                        icon: 'error',
                        title: err.responseJSON.message,
                        timer: 1500
                    });
                }
            })
        });
    </script>
@endpush

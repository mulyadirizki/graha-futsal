@extends('admin.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Booking Lapangan | Futsal</title>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="page-title">Booking Lapangan Futsal</h2>
            <p class="text-muted">pastikan Jadwal Lapangan tersedia</p>
            <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">Booking Lapangan</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="https://lh3.googleusercontent.com/p/AF1QipM9ItiQ9M0D5rsMKr-VizgPoV0Teib2d0VYXYBi=s680-w680-h510" class="d-block img-fluid venue-pic" alt="..." style="border-radius: 12px; width: 100%; height: auto; aspect-ratio: 88 / 61; object-fit: cover;">
                    </div> <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="example-select">Pilih Lapangan</label>
                            <select class="form-control" id="id_lapangan" name="id_lapangan">
                                <option disabled selected>Pilih Lapangan</option>
                                @foreach($data as $dt)
                                <option value="{{ $dt->id_lapangan }}">{{ $dt->dsc_lapangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="example-select">Tgl Main</label>
                            <input type="date" name="tgl_booking" id="tgl_booking" class="form-control" onChange="choseDate()">
                        </div>
                        <input type="hidden" id="id_tuser" value="{{ Auth::user()->id_tuser }}">
                        <div class="form-group mb-3">
                            <label for="example-select">Jam Main</label>
                            <select id="jam_mulai" name="jam_mulai"  class="form-control">
                                <option disabled selected>Jam Mulai</option>

                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="example-select">Jam Berakhir</label>
                            <select id="jam_berakhir" name="jam_berakhir" class="form-control">
                                <option>Jam Berakhir</option>

                            </select>
                        </div>
                        <div class="col-md-12 text-right">
                            <button type="button" onclick="addbooking()" class="btn primary-btn">Booking Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
            </div> <!-- / .card -->
        </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let url=document.URL;
    const myArray=url.split('/');
    url=myArray[0]+"//"+myArray[2];
    $(document).ready(function () {
    });

    function choseDate() {
        var date = new Date($('#tgl_booking').val()),
            day  = ("0" + date.getDate()).slice(-2),
            mnth = ("0" + (date.getMonth() + 1)).slice(-2);
        var tgl_booking = [date.getFullYear(), mnth, day].join("-");
        console.log(tgl_booking)
        check_schedule(tgl_booking);
    }
    function check_schedule(date) {
        const id_lapangan = $('#id_lapangan').val();
        $.ajax({
            type: "POST",
            url: url+"/api/check-schedule",
            data: {
                tgl_booking:date,
                id_lapangan:id_lapangan
            },
            dataType: "JSON",
            success: function (response) {
                if (response.status=='success') {
                    $.each(response.schedule, function (index, value) { 
                        let start=[];
                        let finish=[];
                        let time=value.time;
                        $.each(time.mulai, function (index, value) { 
                            start+=`<option value="${value}">${value.substring(0,5)}</option>`;
                        });
                        $.each(time.selesai, function (index, value) { 
                            finish+=`<option value="${value}">${value.substring(0,5)}</option>`;
                        });
                        $("#jam_mulai").html(`<option disabled selected>Jam Mulai</option>${start}`);
                        $("#jam_berakhir").html(`<option disabled selected>Jam Berakhir</option>${finish}`);
                    });

                }
            },error:function(){
                console.warn('something wrong');
            }
        });
    }

    function addbooking() {
    var id_lapangan1 = $('#id_lapangan').val();

    var date = new Date(),
      mnth = ("0" + (date.getMonth() + 1)).slice(-2),
      day = ("0" + date.getDate()).slice(-2);

    let id_tuser = $('#id_tuser').val();
    let idLapangan = id_lapangan1;
    var tgl_booking = [date.getFullYear(), mnth, day].join("-");
    let jam_mulai = $('select[name=jam_mulai] option').filter(':selected').val();
    let jam_berakhir = $('select[name=jam_berakhir] option').filter(':selected').val();

    $.ajax({
        url: url+"/api/booking/create",
        type: "POST",
        data: {
            id_tuser: id_tuser,
            id_lapangan: idLapangan,
            tgl_booking: tgl_booking,
            jam_mulai: jam_mulai,
            jam_berakhir: jam_berakhir
        },
        dataType: 'JSON',
        success:function(hasil) {
            Swal.fire({
                icon: 'success',
                title: 'Booking Lapangan Berhasil, Silahkan lakukan pembayaran',
                timer: 1500
            });

            // window.location.href = "/id/u/pemain/pembayaran";
        }
    });
}
</script>
@endpush
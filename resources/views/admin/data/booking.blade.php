@extends('admin.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Booking | Futsal</title>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Booking</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <div>
                                    <button class="btn btn-info" id="generate-pdf">PDF</button>
                                </div><br>
                                <div class="row row-cols-md-auto g-2 align-items-center">
                                    <div class="col-3">
                                        <label for="awaltgl">Periode </label>
                                        <input type="date" class="form-control form-control-sm" id="tgl_booking">
                                    </div>
                                    <div class="col-3">
                                        <label for="akhirtgl">- Booking</label>
                                        <input type="date" class="form-control form-control-sm" id="tgl_bookingAkhir">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-cari btn-sm form-control">Search</button>
                                    </div>
                                </div>
                                <br>
                                <table class="table table-striped table-responsive table-bordered nowrap" cellspacing="0" width="100%" id="dataTable-1">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemain</th>
                                            <th>Lapangan</th>
                                            <th>Harga Lapangan</th>
                                            <th>Tgl Booking</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Berakhir</th>
                                            <th>Lama Main</th>
                                            <th>Total Biaya</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- simple table -->
                </div> <!-- end section -->
            </div> <!-- .col-12 -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
    <script>
        var userName = "{{ $userName }}";
        $(document).ready(function() {
            function load() {

                let today = new Date();

                let year = today.getFullYear();
                let month = (today.getMonth() + 1).toString().padStart(2, '0');
                let day = today.getDate().toString().padStart(2, '0');

                let formattedDate = `${year}-${month}-${day}`;

                let tgl_booking = year + '-' + month + '-' + day;
                $('#tgl_booking').val(tgl_booking);

                let tgl_bookingAkhir = year + '-' + month + '-' + day ;
                $('#tgl_bookingAkhir').val(tgl_bookingAkhir);

                var listQuery = {
                    page: 1,
                    limit: 2000,
                    sort: '+nama',
                    tgl_booking: tgl_booking,
                    tgl_bookingAkhir: tgl_bookingAkhir
                };

                let table = $('#dataTable-1').DataTable({
                    ajax: {
                        url: "{{ route('booking') }}",
                        method: 'GET',
                        data: listQuery,
                        dataSrc: function (json) {
                            return json;
                        },
                        error: function (error) {
                            console.error("Error fetching data", error);
                        }
                    },
                    columns: [
                        { data: null, render: function (data, type, row, meta) { return meta.row + 1; } },
                        { data: 'nama' },
                        { data: 'dsc_lapangan' },
                        { data: 'harga_lapangan', render: function (data) { return `Rp. ${number_format(data)} /Jam`; } },
                        { data: 'tgl_booking' },
                        { data: 'jam_mulai', render: function (data) { return substr(data, 0, 5) + ' WIB'; } },
                        { data: 'jam_berakhir', render: function (data) { return substr(data, 0, 5) + ' WIB'; } },
                        { data: 'diff', render: function (data) { return substr(data, 0, 2) + ' Jam'; } },
                        { data: 'total_biaya', render: function (data) { return `Rp. ${number_format(data)}`; } },
                        { data: 'id_transaksi', render: function (data) { return data ? '<span class="badge badge-success">Sudah Bayar</span>' : '<span class="badge badge-warning">Belum Bayar</span>'; } }
                    ],
                    destroy: true
                });

                $('.btn-cari').click(function (e) {
                    e.preventDefault();

                    var tgl_booking = $('#tgl_booking').val();
                    var tgl_bookingAkhir = $('#tgl_bookingAkhir').val();

                    listQuery.tgl_booking = tgl_booking;
                    listQuery.tgl_bookingAkhir = tgl_bookingAkhir;

                    let table2 = $('#dataTable-1').DataTable({
                        ajax: {
                            url: "{{ route('booking') }}",
                            method: 'GET',
                            data: listQuery,
                            dataSrc: function (json) {
                                return json;
                            },
                            error: function (error) {
                                console.error("Error fetching data", error);
                            }
                        },
                        columns: [
                            { data: null, render: function (data, type, row, meta) { return meta.row + 1; } },
                            { data: 'nama' },
                            { data: 'dsc_lapangan' },
                            { data: 'harga_lapangan', render: function (data) { return `Rp. ${number_format(data)} /Jam`; } },
                            { data: 'tgl_booking' },
                            { data: 'jam_mulai', render: function (data) { return substr(data, 0, 5) + ' WIB'; } },
                            { data: 'jam_berakhir', render: function (data) { return substr(data, 0, 5) + ' WIB'; } },
                            { data: 'diff', render: function (data) { return substr(data, 0, 2) + ' Jam'; } },
                            { data: 'total_biaya', render: function (data) { return `Rp. ${number_format(data)}`; } },
                            { data: 'id_transaksi', render: function (data) { return data ? '<span class="badge badge-success">Sudah Bayar</span>' : '<span class="badge badge-warning">Belum Bayar</span>'; } }
                        ],
                        destroy: true
                    });
                })
            }

            function number_format(number, decimals, dec_point, thousands_sep) {
                number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            function substr(str, start, length) {
                return str.substring(start, start + length);
            }

            $('#generate-pdf').click(function() {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                var img = new Image();
                img.src = "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRDIMYVJUja6yxCNZ8yQebiIRf8SQfeqArY2Q&s";  // Ganti dengan path logo Anda
                img.onload = function() {
                    // Lebar halaman
                    var pageWidth = doc.internal.pageSize.getWidth();
                    var pageHeight = doc.internal.pageSize.getHeight();

                    // Lebar gambar
                    var imgWidth = 50;
                    var imgHeight = 30;

                    // Posisi gambar di sebelah kiri
                    var imgX = 10;

                    // Tambahkan gambar (logo) di sebelah kiri
                    doc.addImage(img, 'PNG', imgX, 15, imgWidth, imgHeight);

                    // Tambahkan teks di tengah sejajar dengan gambar
                    doc.setFontSize(15);
                    doc.text("Graha Futsal", pageWidth / 2, 25, null, null, 'center');
                    doc.text("Jln. By Pass Taluak Ampek Suku", pageWidth / 2, 32, null, null, 'center');
                    doc.text("LAPORAN BOOKING", pageWidth / 2, 45, null, null, 'center');

                    // Offset untuk tabel agar tidak bertumpuk dengan teks
                    var startY = 55;

                    var columns = ["No", "Nama Pemain", "Lapangan", "Harga Lapangan", "Tgl Booking", "Jam Mulai", "Jam Berakhir", "Lama Main", "Total Biaya", "Status"];
                    var rows = [];

                    $('#dataTable-1 tbody tr').each(function(index, element) {
                        var rowData = [];
                        $(element).find('td').each(function(index, td) {
                            rowData.push($(td).text());
                        });
                        rows.push(rowData);
                    });

                    // Menggunakan jsPDF-AutoTable untuk membuat tabel di PDF
                    doc.autoTable({
                        head: [columns],
                        body: rows,
                        startY: startY // Posisi mulai tabel
                    });

                    // Tambahkan tanggal di pojok kanan bawah
                    var currentDate = new Date();
                    var dateString = 'Bukittinggi, ' + ' ' + currentDate.toLocaleDateString(); // Format tanggal
                    doc.setFontSize(10);
                    doc.text(dateString, pageWidth - 10, pageHeight - 35, null, null, 'right');
                    doc.text(userName, pageWidth - 22, pageHeight - 10, null, null, 'right');
                    doc.save("Laporan_Booking.pdf");
                };
            });

            load();
        });
    </script>
@endpush

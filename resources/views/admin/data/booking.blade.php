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
            $.ajax({
                url: "{{ route('booking') }}",  // URL endpoint dari Laravel
                method: 'GET',
                success: function(data) {
                    var tbody = $('#dataTable-1 tbody');
                    var no = 1;
                    data.forEach(function(item, index) {
                        var statusBayar = item.id_transaksi ? '<span class="badge badge-success">Sudah Bayar</span>' : '<span class="badge badge-warning">Belum Bayar</span>';
                        var row = `<tr>
                            <td>${no++}</td>
                            <td>${item.nama}</td>
                            <td>${item.dsc_lapangan}</td>
                            <td>Rp. ${number_format(item.harga_lapangan)} /Jam</td>
                            <td>${item.tgl_booking}</td>
                            <td>${substr(item.jam_mulai, 0, 5)} WIB</td>
                            <td>${substr(item.jam_berakhir, 0, 5)} WIB</td>
                            <td>${substr(item.diff, 0, 2)} Jam</td>
                            <td>Rp. ${number_format(item.total_biaya)}</td>
                            <td>${statusBayar}</td>
                        </tr>`;
                        tbody.append(row);
                    });

                    // Inisialisasi DataTables setelah data dimuat
                    $('#dataTable-1').DataTable();
                },
                error: function(error) {
                    console.error("Error fetching data", error);
                }
            });

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
        });
    </script>
@endpush

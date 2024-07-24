@extends('admin.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Transaksi | Futsal</title>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Transaksi</h2>
                <div class="row my-4">
                    <!-- Small table -->
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-body">
                                <!-- table -->
                                <div>
                                    <button class="btn btn-info" id="generate-pdf">PDF</button>
                                </div><br>
                                <table class="table table-striped table-bordered nowrap" id="dataTable-1">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pemain</th>
                                            <th>ID Booking</th>
                                            <th>Bank Tujuan</th>
                                            <th>No Rekening</th>
                                            <th>Tgl Pembayaran</th>
                                            <th>Bukti Pembayaran</th>
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
                url: "{{ route('pemilikTransaksi') }}",  // URL endpoint dari Laravel
                method: 'GET',
                success: function(data) {
                    var tbody = $('#dataTable-1 tbody');
                    var no = 1;
                    data.forEach(function(user) {
                        var row = `<tr>
                            <td>${no++}</td>
                            <td>${user.nama}</td>
                            <td>${user.id_booking}</td>
                            <td>${user.jenis_bank}</td>
                            <td>${user.no_rek}</td>
                            <td>${user.tgl_transaksi}</td>
                            <td><img src="{{ url('storage/img/pembayaran') }}/${user.bukti_transaksi}" alt="" style="width: 200px; height: 150px"></td>
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
                    doc.text("LAPORAN TRANSAKSI", pageWidth / 2, 45, null, null, 'center');

                    // Offset untuk tabel agar tidak bertumpuk dengan teks
                    var startY = 55;

                    var columns = ["No", "Nama", "ID Booking", "Bank Tujuan", "No Rekening", "Tgl Pembayaran", "Bukti Pembayaran"];
                    var rows = [];

                    $('#dataTable-1 tbody tr').each(function(index, element) {
                        var rowData = [];
                        $(element).find('td').each(function(index, td) {
                            if (index < 6) {
                                rowData.push($(td).text());
                            } else {
                                var imgUrl = $(td).find('img').attr('src');
                                rowData.push({ img: imgUrl, fit: [35, 20] });  // Menambahkan gambar dengan ukuran yang sesuai
                            }
                        });
                        rows.push(rowData);
                    });

                    // Menggunakan jsPDF-AutoTable untuk membuat tabel di PDF
                    doc.autoTable({
                        head: [columns],
                        body: rows,
                        startY: startY, // Posisi mulai tabel
                        didDrawCell: function (data) {
                            if (data.column.dataKey === 6 && data.cell.raw && data.cell.raw.img) {
                                var img = new Image();
                                img.src = data.cell.raw.img;
                                doc.addImage(img, 'PNG', data.cell.x + 2, data.cell.y + 2, 35, 20);
                            }
                        }
                    });

                    // Tambahkan tanggal dan nama pengguna di pojok kanan bawah
                    var currentDate = new Date();
                    var dateString = 'Bukittinggi, ' + currentDate.toLocaleDateString(); // Format tanggal
                    doc.setFontSize(10);
                    doc.text(dateString, pageWidth - 10, pageHeight - 35, null, null, 'right');
                    doc.text(userName, pageWidth - 22, pageHeight - 10, null, null, 'right');

                    doc.save("Laporan_Transaksi.pdf");
                };
            });
        });
    </script>
@endpush

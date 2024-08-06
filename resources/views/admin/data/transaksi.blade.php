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
                                <div class="row row-cols-md-auto g-2 align-items-center">
                                    <div class="col-3">
                                        <label for="awaltgl">Periode </label>
                                        <input type="date" class="form-control form-control-sm" id="tgl_transaksi">
                                    </div>
                                    <div class="col-3">
                                        <label for="akhirtgl">- Tanggal Pembayaran</label>
                                        <input type="date" class="form-control form-control-sm" id="tgl_transaksiAkhir">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary btn-cari btn-sm form-control">Search</button>
                                    </div>
                                </div>
                                <br>
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

            function load() {

                let today = new Date();

                let year = today.getFullYear();
                let month = (today.getMonth() + 1).toString().padStart(2, '0');
                let day = today.getDate().toString().padStart(2, '0');

                let formattedDate = `${year}-${month}-${day}`;

                let tgl_transaksi = year + '-' + month + '-' + day;
                $('#tgl_transaksi').val(tgl_transaksi);

                let tgl_transaksiAkhir = year + '-' + month + '-' + day ;
                $('#tgl_transaksiAkhir').val(tgl_transaksiAkhir);

                var listQuery = {
                    page: 1,
                    limit: 2000,
                    sort: '+nama',
                    tgl_transaksi: tgl_transaksi,
                    tgl_transaksiAkhir: tgl_transaksiAkhir
                };

                let table = $('#dataTable-1').DataTable({
                    ajax: {
                        url: "{{ route('transaksi') }}",
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
                        { data: 'id_booking' },
                        { data: 'jenis_bank' },
                        { data: 'no_rek' },
                        { data: 'tgl_transaksi' },
                        {
                            data: 'bukti_transaksi',
                            render: function (data, type, row) {
                                // Membuat URL gambar dengan menggunakan data bukti_transaksi
                                var imgSrc = `{{ url('storage/img/pembayaran') }}/${data}`;
                                return `<img src="${imgSrc}" alt="Bukti Transaksi" style="width: 200px; height: 150px">`;
                            }
                        }
                    ],
                    destroy: true
                });

                $('.btn-cari').click(function (e) {
                    e.preventDefault();

                    var tgl_transaksi = $('#tgl_transaksi').val();
                    var tgl_transaksiAkhir = $('#tgl_transaksiAkhir').val();

                    listQuery.tgl_transaksi = tgl_transaksi;
                    listQuery.tgl_transaksiAkhir = tgl_transaksiAkhir;

                    let table2 = $('#dataTable-1').DataTable({
                        ajax: {
                            url: "{{ route('transaksi') }}",
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
                            { data: 'id_booking' },
                            { data: 'jenis_bank' },
                            { data: 'no_rek' },
                            { data: 'tgl_transaksi' },
                            {
                                data: 'bukti_transaksi',
                                render: function (data, type, row) {
                                    // Membuat URL gambar dengan menggunakan data bukti_transaksi
                                    var imgSrc = `{{ url('storage/img/pembayaran') }}/${data}`;
                                    return `<img src="${imgSrc}" alt="Bukti Transaksi" style="width: 200px; height: 150px">`;
                                }
                            }
                        ],
                        destroy: true
                    });
                })
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

            load();
        });
    </script>
@endpush

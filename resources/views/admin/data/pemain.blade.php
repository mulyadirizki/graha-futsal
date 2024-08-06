@extends('admin.default')

@push('meta')
    <meta name="author" content="HPV">
    <meta name="keywords" content="">
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('title')
    <title>Data Pemain | Futsal</title>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="mb-2 page-title">Data Pemain</h2>
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
                                        <input type="date" class="form-control form-control-sm" id="created_at">
                                    </div>
                                    <div class="col-3">
                                        <label for="akhirtgl">- Tanggal Registrasi</label>
                                        <input type="date" class="form-control form-control-sm" id="created_atAkhir">
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
                                            <th>Nama</th>
                                            <th>Tgl Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>No HP</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Tgl Daftar</th>
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

                let created_at = year + '-' + month + '-' + day;
                $('#created_at').val(created_at);

                let created_atAkhir = year + '-' + month + '-' + day ;
                $('#created_atAkhir').val(created_atAkhir);

                var listQuery = {
                    page: 1,
                    limit: 2000,
                    sort: '+nama',
                    created_at: created_at,
                    created_atAkhir: created_atAkhir
                };

                let table = $('#dataTable-1').DataTable({
                    ajax: {
                        url: "{{ route('pemainAdmin') }}",
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
                        { data: 'tgl_lahir' },
                        { data: 'jkel' },
                        { data: 'no_hp' },
                        { data: 'email' },
                        { data: 'alamat' },
                        { data: 'formatted_created_at' },
                    ],
                    destroy: true
                });

                $('.btn-cari').click(function (e) {
                    e.preventDefault();

                    var created_at = $('#created_at').val();
                    var created_atAkhir = $('#created_atAkhir').val();

                    listQuery.created_at = created_at;
                    listQuery.created_atAkhir = created_atAkhir;

                    let table2 = $('#dataTable-1').DataTable({
                        ajax: {
                            url: "{{ route('pemainAdmin') }}",
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
                            { data: 'tgl_lahir' },
                            { data: 'jkel' },
                            { data: 'no_hp' },
                            { data: 'email' },
                            { data: 'alamat' },
                            { data: 'formatted_created_at' },
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
                    doc.text("LAPORAN REGISTRASI", pageWidth / 2, 45, null, null, 'center');

                    // Offset untuk tabel agar tidak bertumpuk dengan teks
                    var startY = 55;

                    var columns = ["No", "Nama", "Tanggal Lahir", "Jenis Kelamin", "No HP", "Email", "Alamat"];
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
                    doc.save("Laporan_Registrasi.pdf");
                };
            });

            load();
        });
    </script>
@endpush

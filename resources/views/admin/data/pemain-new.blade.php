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
                                            <th>Status</th>
                                            <th>Actions</th>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        var userName = "{{ $userName }}";
        $(document).ready(function() {
            $.ajax({
                url: "{{ route('pemainAdminNew') }}",  // URL endpoint dari Laravel
                method: 'GET',
                success: function(data) {
                    var tbody = $('#dataTable-1 tbody');
                    var no = 1;
                    tbody.empty(); // Kosongkan tbody sebelum menambahkan baris baru
                    data.forEach(function(user) {
                        var row = `<tr>
                            <td>${no++}</td>
                            <td>${user.nama}</td>
                            <td>${user.tgl_lahir}</td>
                            <td>${user.jkel}</td>
                            <td>${user.no_hp}</td>
                            <td>${user.email}</td>
                            <td>${user.alamat}</td>
                            <td><span class="badge badge-warning">${user.statusenabled}</span></td>
                            <td><button class="btn btn-success btn-sm btnVerify" data-id="${user.id_tuser}">Verify</button></td>
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

            $(document).on('click', '.btnVerify', function () {
                const userId = $(this).data('id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan memverifikasi pengguna ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Verifikasi!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('verifyUser', ['id' => ':id']) }}".replace(':id', userId),
                            type: 'post',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function (data) {
                                if (data.success) {
                                    Swal.fire(
                                        'Terverifikasi!',
                                        'Pengguna telah diverifikasi.',
                                        'success'
                                    ).then(() => {
                                        // Muat ulang halaman setelah dialog Swal ditutup
                                        window.location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Gagal!',
                                        'Terjadi kesalahan, coba lagi.',
                                        'error'
                                    );
                                }
                            },
                            error: function () {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan, coba lagi.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            function refreshTable() {
                $.ajax({
                    url: "{{ route('pemainAdminNew') }}",
                    method: 'GET',
                    success: function(data) {
                        var tbody = $('#dataTable-1 tbody');
                        var no = 1;
                        tbody.empty(); // Kosongkan tbody sebelum menambahkan baris baru
                        data.forEach(function(user) {
                            var row = `<tr>
                                <td>${no++}</td>
                                <td>${user.nama}</td>
                                <td>${user.tgl_lahir}</td>
                                <td>${user.jkel}</td>
                                <td>${user.no_hp}</td>
                                <td>${user.email}</td>
                                <td>${user.alamat}</td>
                                <td><span class="badge badge-warning">${user.statusenabled}</span></td>
                                <td><button class="btn btn-success btn-sm btnVerify" data-id="${user.id_tuser}">Verify</button></td>
                            </tr>`;
                            tbody.append(row);
                        });

                        // Hancurkan DataTable yang ada dan inisialisasi ulang
                        $('#dataTable-1').DataTable().destroy();
                        $('#dataTable-1').DataTable();
                    },
                    error: function(error) {
                        console.error("Error fetching data", error);
                    }
                });
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
        });
    </script>
@endpush

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Check Up</title>
    <style>
        /* reset */
        body {
            background-color: #f6f6f6;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            -webkit-font-smoothing: antialiased;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            color: black;
        }
        img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 200px; 
        }
        /* content */
        .body {
            background-color: #F3F7F9;
            width: 100%; 
        }
        .container {
            display: block;
            margin: 0 auto !important;
            /* makes it centered */
            max-width: 680px;
            padding: 10px;
            width: 100%;
        }
        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 680px;
            padding: 10px; 
        }
        .main {
            background: #ffffff;
            border-radius: 3px;
            width: 100%; 
        }
        .wrapper {
            box-sizing: border-box;
            padding: 50px; 
        }
        #data_head {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            font-size: 12px;
            width: 100%;
        }
        #data td,
        #data th,
        #data pre {
            border: 1px solid rgb(0, 0, 0);
            font-size: 12px;
            padding: 4px;
            width: 100%;
        }
        p {
            white-space: pre-line;
        }
        input[type=checkbox] {
            transform: scale(1.5);
        }
        @media only screen and (max-width: 620px) {
            body {
                font-size: 8px;
            }
            .body .container{
                padding: 0 !important;
                width: 100% !important;
            }
            .body .content {
                padding: 0 !important;
            }
            .body .wrapper {
                padding: 20px !important;
            }
        }
    </style>
</head>
<body>
    <div class="body">
        <div class="container">
            <div class="content">
                <div class="main">
                    <div class="wrapper">
                        <table id="data_head">
                            <thead>
                                <!-- <tr>
                                    <td>
                                        <img src="https://www.pngfind.com/pngs/m/246-2460728_gh-gaming-logo-hd-png-download.png" alt="Graha Futsal">
                                        <td width="30%"></td>
                                        <td width="30%"></td>
                                    </td>
                                </tr> -->
                                <tr>
                                    <td colspan="4" align="center">
                                        <font size="3"><br><b>KONFIRMASI PEMBAYARAN <br>GRAHA FUTSAL</b></font>
                                    </td>
                                </tr>
                            </thead>
                        </table>
                        <div>
                            <br>
                            <p>Halo {{ $send_email['nama'] }}</p>
                            <p>Kamu baru saja melakukan konfirmasi pembayaran booking lapangan futsal</p>
                            <table>
                                <tr>
                                    <td colspan="2"><b><h2>Detail Transaksi</h2></b><hr></td>
                                </tr>
                                <tr>
                                    <td>ID Transaksi</td>
                                    <td>: {{ $send_email['id_transaksi'] }}</td>
                                </tr>
                                <tr>
                                    <td>No HP</td>
                                    <td>: {{ $send_email['no_hp'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tgl Transaksi</td>
                                    <td>: {{ $send_email['tgl_transaksi'] }}</td>
                                </tr>
                                <tr>
                                    <td>Total Biaya</td>
                                    <td>:Rp. {{ number_format($send_email['total_biaya']) }}</td>
                                </tr>
                            </table>
                            <br>
                            <p>Terimakasih telah melakukan konfirmasi pembayaran,<span style="color:red;"> silahkan datang ke lapangan 15 menit sebelum waktu pertandingan dimulai</span></p>

                            <p>Salam hangat, <br>Tim Graha Futsal</p>
                        </div>
                        <br>
                        <p>
                            Bukittinggi, Indonesia, {{ date('M d, Y') }} <br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
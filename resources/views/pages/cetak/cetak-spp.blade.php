<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Bukti Pembayaran SPP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            width: 70%;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header p {
            margin: 0;
        }
        .content {
            margin-bottom: 20px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .content th, .content td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        .content th {
            width: 30%;
            /* background-color: #f2f2f2; */
        }
        .content td {
            width: 70%;
        }
        .footer {
            text-align: right;
        }
        .footer p {
            margin: 0;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature p {
            margin: 0;
        }
        .signature .name {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Nota Bukti Pembayaran SPP</h1>
            <p>Nama Sekolah</p>
            <p>Alamat Sekolah</p>
        </div>
        <div class="content">
            <table>
                <tr>
                    <th>Nama Siswa</th>
                    <td>AJisaka Siddiq</td>
                    {{-- <td>{{ $nama_siswa }}</td> --}}
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>XII IPA 3</td>
                    {{-- <td>{{ $kelas }}</td> --}}
                </tr>
                <tr>
                    <th>Bulan</th>
                    <td>Mei 2024</td>
                    {{-- <td>{{ $bulan }}</td> --}}
                </tr>
                <tr>
                    <th>Jumlah Pembayaran</th>
                    <td>Rp. 1.000.000</td>
                    {{-- <td>Rp. {{ number_format($jumlah_pembayaran, 0, ',', '.') }}</td> --}}
                </tr>
                <tr>
                    <th>Tanggal Pembayaran</th>
                    <td>{{ \Carbon\Carbon::now()->format('d M Y') }}</td>
                    {{-- <td>{{ \Carbon\Carbon::now()->format('d M Y') }}</td> --}}
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>Terima kasih atas pembayaran SPP Anda.</p>
        </div>
        <div class="signature">
            <p>Mengetahui,</p>
            <p class="name">(_______________________)</p>
        </div>
    </div>
</body>
</html>

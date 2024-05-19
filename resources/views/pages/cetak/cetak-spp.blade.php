<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Bukti Pembayaran SPP</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            height: 100vh;
            padding: 20mm;
            box-sizing: border-box;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 0;
            font-size: 14px;
        }
        .content {
            margin-bottom: 20px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
        }
        .content th, .content td {
            padding: 8px 15px;
            text-align: left;
            vertical-align: top;
        }
        .content th {
            width: 40%;
            background-color: #f2f2f2;
        }
        .content td {
            width: 60%;
        }
        .footer {
            text-align: right;
            margin-top: 50px;
        }
        .footer p {
            margin: 0;
            font-size: 14px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature p {
            margin: 0;
            font-size: 14px;
        }
        .signature .name {
            margin-top: 50px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container" id="print-area">
        <div class="header">
            <h1>Nota Bukti Pembayaran SPP</h1>
            <p>MTs. Zainul Hasan Balung</p>
            <p>Alamat Sekolah</p>
        </div>
        <div class="content">
            <table>
                @foreach ($transaksi as $item)
                <tr>
                    <th>Nama Siswa</th>
                    <td>: {{ $item->user->name }}</td>
                </tr>
                <tr>
                    <th>Kelas</th>
                    <td>: {{ $item->user->kelas }}</td>
                </tr>
                <tr>
                    <th>Bulan</th>
                    <td>: {{ $item->keterangan }}</td>
                </tr>
                <tr>
                    <th>Jumlah Pembayaran</th>
                    <td>: Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pembayaran</th>
                    <td>: {{ \Carbon\Carbon::parse($item->tgl_pembayaran)->format('d M Y') }}</td>
                </tr>
                @endforeach
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
    <script>
        window.print();

        window.onafterprint = function() {
            document.body.innerHTML = '';
        };
    </script>
</body>
</html>

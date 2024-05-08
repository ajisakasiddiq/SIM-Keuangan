<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tagihan Bulanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .invoice-group {
            margin-bottom: 20px;
        }
        .invoice-details {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Tagihan Bulanan {{ $user->name }}</h2>

        @foreach ($tagihans as $tagihanId => $tagihanGroup)
            @php
                $firstTagihan = reset($tagihanGroup); // Ambil entitas pertama dari tagihanGroup untuk mendapatkan nama jenistagihan
                $jenisTagihan = $firstTagihan ? $firstTagihan['nama'] : '';
                $totalTagihanGrup = collect($tagihanGroup)->sum('total_tagihan'); // Menghitung total tagihan pada grup
            @endphp
            <div class="invoice-group">
                <h3>Detail Tagihan ({{ $jenisTagihan }} - Tagihan ID: {{ $tagihanId }})</h3>
                
                <table>
                    <thead>
                        <tr>
                            <th>Keterangan</th>
                            <th>Total Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tagihanGroup as $tagihan)
                            <tr>
                                <td>{{ $tagihan['keterangan'] }}</td>
                                <td>Rp {{ number_format($tagihan['total_tagihan'], 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="bg-secondary">
                            <th>Total Grup</th>
                            <th>Rp {{ number_format($totalTagihanGrup, 0, ',', '.') }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach

        {{-- @php
            $totalTagihanSeluruh = collect($tagihans)->flatMap->pluck('total_tagihan')->sum(); // Menghitung total tagihan keseluruhan
        @endphp --}}

        <p>Total Tagihan Keseluruhan: Rp {{ number_format($totalTagihanGrup, 0, ',', '.') }}</p>

        <p>Terima kasih telah menggunakan layanan kami. Mohon segera melakukan pembayaran sesuai dengan jumlah tagihan di atas.</p>

        <div class="footer">
            <p>Jika Anda memiliki pertanyaan terkait tagihan ini, silakan hubungi layanan pelanggan kami di <strong>0800-123-4567</strong> atau melalui email <strong>customer-service@example.com</strong>.</p>
        </div>
    </div>
</body>
</html>

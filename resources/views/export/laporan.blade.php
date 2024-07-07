<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @php
    use Carbon\Carbon;
    Carbon::setLocale('id'); // Set locale ke Bahasa Indonesia ('id')
@endphp
<table class="table-bordered text-center scroll-horizontal-vertical w-100">
    <thead>
        <tr>
            <th colspan="4">
                <h1 class="text-center bg-secondary">Laporan Keuangan {{ Carbon::createFromFormat('m', $bulan)->translatedFormat('F') }} {{ $tahun }}</h1>
            </th>
        </tr>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Name</th>
            <th class="text-center" colspan="2">Total</th>
        </tr>
        <tr>
            <th class="bg-success text-light">Pemasukan</th> <!-- Warna hijau untuk Pemasukan -->
            <th class="bg-danger text-light">Pengeluaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->nama_tagihan }}</td>
            @if($data->jenis_transaksi == 'Pendapatan')
                <td>Rp. {{ number_format($data->jumlah, 0, ',', '.') }}</td>
                <td>-</td>
            @elseif($data->jenis_transaksi == 'Pengeluaran')
                <td>-</td>
                <td>Rp. {{ number_format($data->jumlah, 0, ',', '.') }}</td>
            @endif
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td>Total</td>
            <td>Rp. {{ number_format($totalsaldo, 0, ',', '.') }}</td>
            <td>Rp. {{ number_format($totalpengeluaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="3">Jumlah Saldo {{ Carbon::createFromFormat('m', $bulan)->translatedFormat('F') }} {{ $tahun }}</td>
            <td>Rp. {{ number_format($totalsaldo - $totalpengeluaran, 0, ',', '.') }}</td>
        </tr>
    </tbody>
</table>

</body>
</html>
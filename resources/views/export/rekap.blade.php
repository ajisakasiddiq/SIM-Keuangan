<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Pendapatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .text-center {
            text-align: center;
        }
        .table-bordered {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table-bordered th {
            background-color: #f2f2f2;
            text-align: center;
        }
        .table-bordered td {
            text-align: center;
        }
        .total-amount {
            margin-top: 20px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <h1 class="text-center">Rekapitulasi {{ $title }}</h1>
    <table class="table-bordered">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Tanggal Transaksi</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->jenistagihan->name }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tgl_pembayaran)->format('d M Y') }}</td>
                    <td>
                        @switch($item->status)
                            @case(0)
                                <span class="badge badge-warning">Menunggu Pembayaran</span>
                                @break
                            @case(1)
                                <span class="badge badge-info">Pending</span>
                                @break
                            @case(2)
                                <span class="badge badge-success">Lunas</span>
                                @break
                            @default
                                <span class="badge badge-danger">Undefined</span>
                        @endswitch
                    </td>
                    <td>Rp. {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total-amount">
        Total: Rp. {{ number_format($jumlahtotal, 0, ',', '.') }}
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi {{ $title }}</title>
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
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->jenistagihan->name }}</td>
                    <td>{{ $item->keterangan }}</td>
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

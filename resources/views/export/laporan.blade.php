@php
    use Carbon\Carbon;
    Carbon::setLocale('id'); // Set locale ke Bahasa Indonesia ('id')
@endphp

<table class="table-bordered text-center scroll-horizontal-vertical w-100">
    <thead>
        <tr>
            <th rowspan="2">Name</th>
            <th colspan="2">Total</th> 
        </tr>
        <tr>
           
            <th class="bg-success text-light">Pemasukan</th> <!-- Warna hijau untuk Pemasukan -->
            <th class="bg-danger text-light">Pengeluaran</th> 
        </tr>
    </thead>
      <tbody>
          @foreach($transactions as $data)
        <tr>
            <td>{{ $data->nama_tagihan }}</td>
            @if($data->jenis_transaksi == 'Pendapatan')
            <td >Rp. {{ number_format($data->jumlah, 0, ',', '.') }}</td>
            <td >-</td> 
             <!-- Warna hijau untuk Pemasukan -->
             @elseif($data->jenis_transaksi == 'Pengeluaran')
             <td >-</td>
            <td >Rp. {{ number_format($data->jumlah, 0, ',', '.') }}</td> 
            @endif
        </tr>
        @endforeach
        <tr>
            <td >Total</td>
            <td >Rp. {{ number_format($totalsaldo, 0, ',', '.') }}</td>
            <td >Rp. {{ number_format($totalpengeluaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2">Jumlah Saldo {{ Carbon::createFromFormat('m', $bulan)->translatedFormat('F') }}
                {{ $tahun }}</td>
                <td colspan="2">Rp. {{ number_format($totalsaldo - $totalpengeluaran, 0, ',', '.') }}</td>
        </tr>
      </tbody>
      
    </table>

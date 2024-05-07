<table>
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Name</th>
            <th colspan="2">Total</th> 
        </tr>
        <tr>
           
            <th class="bg-success text-light">Pemasukan</th> <!-- Warna hijau untuk Pemasukan -->
            <th class="bg-danger text-light">Pengeluaran</th> 
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $data->nama_tagihan }}</td>
                @if($data->jenis_transaksi == 'Pendapatan')
                    <td>{{ $data->jumlah }}</td>
                    <td>0</td>
                @elseif($data->jenis_transaksi == 'Pengeluaran')
                    <td>0</td>
                    <td>{{ $data->jumlah }}</td>
                @endif
            </tr>
        @endforeach
        <tr>
            <td colspan="2">Total</td>
            <td>Rp. </td>
        </tr>
        <tr>
            <td colspan="2">Jumlah Saldo</td>
            <td>Rp. </td>
            <td>Rp. </td>
        </tr>
    </tbody>
</table>

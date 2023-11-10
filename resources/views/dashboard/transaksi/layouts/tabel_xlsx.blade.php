<table>
    <tr>
        <th scope="col">Tanggal</th>
        <th scope="col">No transaksi</th>
        <th scope="col">Jenis Transaksi</th>
        <th scope="col" align="right">Jumlah</th>
    </tr>
        @foreach ($transaksi as $index => $t)
        <tr>
            <div>
                <th scope="row">
                    {{ $t->tanggal }}</th>
                <td>{{ $t->no_transaksi ?? '--' }}</td>
                <td>
                    @if ($t->jenis_transaksi->nama == 'Pemasukan')
                    Pemasukan
                    @elseif ($t->jenis_transaksi->nama == 'Pengeluaran')
                    Pengeluaran
                    @elseif ($t->jenis_transaksi->nama == 'Tabungan')
                    Tabungan
                    @else
                    --
                    @endif
                </td>
                <td align="right">Rp
                    {{ number_format($t->jumlah, 0, ',', '.') }}</td>
            </div>
        </tr>
        @endforeach
</table>
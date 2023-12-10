<table>
    <tr>
        <th scope="col">Tanggal</th>
        <th scope="col">No transaksi</th>
        <th scope="col">Jenis Transaksi</th>
        <th>Kategori Transaksi</th>
        <th>Supplier/Costumer</th>
        <th>Deskripsi</th>
        <th scope="col" align="right">Jumlah</th>
    </tr>
        @foreach ($transaksi as $index => $t)
        <tr>
            <div>
                <th scope="row">
                    {{ $t->tanggal }}</th>
                <td>{{ $t->no_transaksi ?? '--' }}</td>
                <td>
                    @if ($t->jenis_transaksi->nama == 'Pendapatan Tetap')
                    Pendapatan Tetap
                    @elseif ($t->jenis_transaksi->nama == 'Pendapatan Tidak Tetap')
                    Pendapatan Tidak Tetap
                    @elseif ($t->jenis_transaksi->nama == 'Pengeluaran Pokok')
                    Pengeluaran Pokok
                    @elseif ($t->jenis_transaksi->nama == 'Pengeluaran Tambahan')
                    Pengeluaran Tambahan
                    @elseif ($t->jenis_transaksi->nama == 'Tabungan')
                    Tabungan
                    @else
                    --
                    @endif
                </td>
                <td>{{$t->kategori_transaksi->nama}}</td>
                <td>{{$t->suppliers_or_customers->nama_bisnis ?? '--'}}</td>
                <td>{{$t->deskripsi ?? '--'}}</td>
                <td align="right">Rp
                    {{ number_format($t->jumlah, 0, ',', '.') }}</td>
            </div>
        </tr>
        @endforeach
</table>

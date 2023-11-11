<table>
    <thead>
        <tr>
            <th>no transaksi</th>
            <th>Tanggal</th>
            <th>kategori</th>
            <th>costumer/supplier</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <th>{{$item->no_transaksi}}</th>
            <td>{{$item->tanggal}}</td>
            <td>{{$item->kategori_transaksi->nama}}</td>
            <td>{{$item->suppliers_or_customers->nama_bisnis ?? '--'}}</td>
            <td>{{$item->deskripsi ?? '--'}}</td>
            <td>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
        </tr>
        @endforeach
        <tr>
            <th scope="row" align="left" colspan="5">Jumlah Total</th>
            <td>Rp {{number_format($pengeluaran, 0, ',', '.')}}</td>
        </tr>
    </tbody>
</table>
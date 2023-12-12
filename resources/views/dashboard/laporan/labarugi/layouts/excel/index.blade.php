<table>
    <thead>
        <tr>
            <th>Nama Akun</th>
            <th>Jumlah</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>* Pemasukan</th>
            <td>Rp {{number_format($pemasukan, 0, ',', '.')}}</td>
        </tr>
        @foreach ($pemasukanByKategori as $item)
        <tr>
            <th>- {{$item->nama}}</th>
            <td>Rp {{number_format($item->jumlah, 0, ',', '.')}}</td>
        </tr>
        @endforeach
        <tr>
            <th>TOTAL PENDAPATAN</th>
            <td>Rp {{number_format($pemasukan, 0, ',', '.')}}</td>
        </tr>

        <tr>
            <th>* Pengeluaran</th>
            <td>Rp {{number_format($pengeluaran, 0, ',', '.')}}</td>
        </tr>
        @foreach ($pengeluaranByKategori as $item)
        <tr>
            <th>- {{$item->nama}}</th>
            <td>Rp {{number_format($item->jumlah, 0, ',', '.')}}</td>
        </tr>
        @endforeach
        <tr>
            <th>TOTAL PENGELUARAN</th>
            <td>Rp {{number_format($pengeluaran, 0, ',', '.')}}</td>
        </tr>
    </tbody>
</table>
@extends('dashboard.layouts.main')

@section('container')
  <div class="bg-white shadow-md rounded-lg border-gray-300 dark:border-gray-600 h-fit mb-4">
    @include('dashboard.kategori.layouts.tabel_categori_transaksi')
  </div>

<script src="js/kategori_transaksi_script.js"></script>
@endsection
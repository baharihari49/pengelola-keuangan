@extends('dashboard.layouts.main')

@section('container')
    <div class="bg-white shadow-md rounded-lg border-gray-300 dark:border-gray-600 h-fit">
      @include('dashboard.transaksi.layouts.tabel_transaksi')
    </div>

  <script src="js/transaksi_script.js"></script>
@endsection
@extends('dashboard.layouts.main')


@section('container')
    <div class="bg-white overflow-x-auto shadow-md rounded-lg border-gray-300 dark:border-gray-600 h-fit mb-32 lg:mb-24">
        @include('dashboard.laporan.pemasukan.layouts.container_laporan_pemasukan')
    </div>
@endsection
@extends('dashboard.layouts.main')

@section('container')
    @include('dashboard.supplier.layouts.tabel_supplier')
    @include('dashboard.supplier.layouts.update_modal')

<script src="./js/supCos/script.js"></script>
@endsection
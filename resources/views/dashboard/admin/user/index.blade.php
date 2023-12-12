@extends('dashboard.layouts.main')


@section('container')
    @include('dashboard.admin.user.layouts.tabel_user')
    @include('dashboard.admin.user.layouts.add_user')
@endsection
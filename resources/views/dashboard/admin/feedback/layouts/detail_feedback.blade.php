@extends('dashboard.layouts.main')
@section('container')
<section class="">
    <h1 class="mt-2 mb-3 text-4xl font-semibold">{{$data[0]->kategori}} <span class="text-sm text-gray-500 font-normal"> #{{$data[0]->no_feedback}} </span></h1>
    <div class="mb-7 flex items-center gap-2">
        <div class="py-0.5 px-5 bg-yellow-200 text-sm text-yellow-800 border-2 border-yellow-300 w-fit rounded-full">{{$data[0]->progres}}</div>
        <p class="text-sm text-gray-500">{{$data[0]->progres_by ?? '--'}}</p>
    </div>
    <div class="grid grid-cols-5 gap-3">
        <div class="col-span-4 bg-white rounded-md shadow-md px-5 pt-5 pb-8">
            <div class="flex items-center gap-2 mb-3">
                <figure>
                    <img class="w-10 h-10 rounded-full"
                        src="{{ isset($data[0]->users_id->foto) && file_exists(public_path('storage/' . $data[0]->users_id->foto)) ? asset('storage/' . $data[0]->users_id->foto) : asset('./image/profile_picture/no_image.jpg') }}"
                        alt="Rounded avatar">
                </figure>
                <div>
                    <p class="text-sm text-gray-700">{{$data[0]->users_id->username}}</p>
                    <p class="text-xs text-gray-700">{{$data[0]->created_at}}</p>
                </div>
            </div>
            <div class="text-gray-500 ml-12">
                {!! $data[0]->deskripsi !!}
            </div>

            <hr class="w-full mt-8 mb-5">
            <p class="ml-12 mb-3 text-gray-800 font-medium text-xl">Lampiran</p>
            <span class="text-gray-400 text-xs ml-12">Tidak ada lampiran</span>

            <hr class="w-full mt-8 mb-5">
            <button class="py-2 px-5 bg-green-600 rounded-xl text-white font-medium text-sm">Mulai Kerjakan</button>
        </div>
        <div class="bg-white p-5 rounded-md shadow-md h-fit">
            <p class="text-xs text-gray-500">Tugas diberikan ke pada:</p>
            <p class="text-gray-700 text-sm font-medium mt-1">Dev Octans Finance</p>

            <p class="text-xs text-gray-500 mt-3">Diselasikan oleh</p>
            <p class="text-gray-700 text-sm font-medium mt-1">{{$data[0]->progres_by->nama ?? '--'}}</p>

            <p class="text-xs text-gray-500 mt-3">Status</p>
            <p class="text-gray-700 text-sm font-medium mt-1">{{$data[0]->progres}}</p>
        </div>
    </div>
</section>
@endsection

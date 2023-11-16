@extends('dashboard.layouts.main')
@section('container')
<section class="mb-32">
    <h1 class="mt-2 mb-3 text-4xl font-semibold">{{$data[0]->kategori}} <span class="text-sm text-gray-500 font-normal"> #{{$data[0]->no_feedback}} </span></h1>
    <div class="mb-7 flex items-center gap-2">
        <div class="py-0.5 px-5
            @switch($data[0]->progres)
                @case('draft')
                    bg-yellow-200 text-yellow-800 border-yellow-300
                    @break

                @case('on going')
                    bg-green-200 text-green-800 border-green-300
                    @break

                @case('cancel')
                    bg-gray-200 text-gray-800 border-gray-300
                    @break

                @default
                    bg-blue-200 text-blue-800 border-blue-300
            @endswitch
            text-sm border-2 w-fit rounded-full">
            {{$data[0]->progres}}
        </div>
        <p class="text-sm text-gray-500"><span class="font-semibold">{{$data[0]->progres_dev_by->username ?? '--'}}</span> <span class="{{($data[0]->progres_by == null) ? 'hidden' : ''}}"><span>
            @switch($data[0]->progres)
                @case('on going')
                    sedang mengerjakan
                    @break
                @case('cancel')
                    batal mengerjakan
                    @break
                @default
                    menyelesaiakan
            @endswitch
        </span> issue ini</span></p>
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
            <p class="ml-12 mb-3 text-gray-800 font-medium text-lg">Lampiran</p>
            @if ( isset($data[0]->lampiran) )
                <div class="ml-12 relative">
                    <img class="w-32 h-32" src="/storage/{{$data[0]->lampiran}}" alt="lampiran">
                    <a target="blank" href="/storage/{{$data[0]->lampiran}}" class="w-32 h-32 text-dark-500 flex items-center justify-center absolute opacity-0 hover:opacity-50 rounded-md top-0 bg-gray-300">
                        Lihat
                    </a>
                </div>
            @else
                <span class="text-gray-400 text-xs ml-12">Tidak ada lampiran</span>
            @endif

            <hr class="w-full mt-8 mb-5">
            @if ($data[0]->progres == 'draft')
            <form action="/on_going/?id={{$data[0]->id}}" method="POST">
                @csrf
                <button type="submit" class="py-2 px-5 ml-12 bg-green-600 rounded-xl text-white font-medium text-sm">Mulai Kerjakan</button>
            </form>
            @elseif ($data[0]->progres == 'on going' && $data[0]->user_id == auth()->user()->id)
            <div class="flex items-center gap-3 w-fit">
                <form action="/cancel_done/?id={{$data[0]->id}}" method="POST">
                    @csrf
                    <button type="submit" class="py-2 px-5 ml-12 bg-red-600 rounded-xl text-white font-medium text-sm">Batal mengerjakan</button>
                </form>
                <form action="/done/?id={{$data[0]->id}}" method="POST">
                    @csrf
                    <button type="submit" class="py-2 px-5 bg-blue-600 rounded-xl text-white font-medium text-sm">Tandai Telah Selesai</button>
                </form>
            </div>
            @elseif($data[0]->progres == 'cancel')
                <form action="/on_going/?id={{$data[0]->id}}" method="POST">
                    @csrf
                    <button type="submit" class="py-2 px-5 ml-12 bg-green-600 rounded-xl text-white font-medium text-sm">Mulai Kerjakan</button>
                </form>
            @elseif($data[0]->progres == 'done')
                <button type="submit" class="py-2 px-5 ml-12 bg-blue-600 rounded-xl text-white font-medium text-sm">Selesai</button>
            @else
                <button disabled type="submit" class="py-2 px-5 ml-12 bg-green-300 rounded-xl text-white font-medium text-sm">Mulai Kerjakan</button>
            @endif
        </div>
        <div class="bg-white p-5 rounded-md shadow-md h-fit">
            <p class="text-xs text-gray-500">Tugas diberikan ke pada:</p>
            <p class="text-gray-700 text-sm font-medium mt-1">Dev Octans Finance</p>

            <p class="text-xs text-gray-500 mt-3">Diselasikan oleh</p>
            <p class="text-gray-700 text-sm font-medium mt-1">{{($data[0]->progres == 'done') ? $data[0]->progres_dev_by->username : '--' ?? '--'}}</p>

            <p class="text-xs text-gray-500 mt-3">Status</p>
            <p class="text-gray-700 text-sm font-medium mt-1">{{$data[0]->progres}}</p>
        </div>
    </div>
</section>
@endsection

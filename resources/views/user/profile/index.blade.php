@extends('dashboard.layouts.main')

@section('container')
@include('user.profile.layouts.modalUplodImage')
@include('user.profile.layouts.deleteImageModal')

<div class="bg-white rounded-xl p-6 shadow-md h-fit mb-5">
    <form method="post" action="/user" class="grid grid-cols-1 lg:grid-cols-5 gap-5" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="col-span-1">
            <div class="flex items-center gap-3">
                <div>
                    <figure class="">
                        <img id="user-image-profile" class="rounded border"
                            src="{{ isset($user->foto) ? 'storage/' . $user->foto : './image/profile_picture/no_image.jpg' }}"
                            alt="foto user - {{ isset($user->username) }}"
                            style="width: 300px;height: 300px;object-fit: cover;border-radius: .5rem;">
                    </figure>
                    <input type="hidden" value="{{ $user->foto }}" name="oldImage">
                    <div class="flex w-full gap-3 mt-3">
                        <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
                            class="bg-blue-600 py-2 px-4 text-white rounded-md">{{ isset($user->foto) ? 'Ubah' : 'Uplod' }}
                            foto</button>
                        <button id="deleteButton" data-modal-toggle="deleteModal" type="button"
                            data-foto="{{ $user->foto }}"
                            class="bg-red-700 {{ isset($user->foto) ? '' : 'hidden' }} py-2 px-4 text-white rounded-md">Hapus
                            foto</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-4 mt-3 lg:mt-0 lg:ml-5">
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" value="{{ $user->nama }}" name="nama" id="nama"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="nama"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama</label>
                {{-- <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400"><span class="font-medium">Oh, snapp!</span> Some error message.</p> --}}
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="email" value="{{ $user->email ?? '--' }}" name="email" id="email"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" value="{{ $user->alamat }}" name="alamat" id="alamat"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="alamat"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Alamat</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="tel" name="username" value="{{ $user->username }}" id="username"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="username"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="tel" name="no_handphone" value="{{ $user->no_handphone }}" id="no_handphone"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="no_handphone"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nomor
                    HP</label>
            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
        </div>
    </form>
</div>
<div class="bg-white rounded-xl p-6 shadow-md h-fit mb-36">
    <h4 class="text-gray-800 text-xl font-medium mb-4">Informasi Bisnis</h4>


    <form action="/store_info_bisnis" method="POST" enctype="multipart/form-data">
        @csrf
    
        <!-- Nama Bisnis -->
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="nama_bisnis" id="nama_bisnis"
                value="{{ isset($info_bisnis[0]) ? $info_bisnis[0]->nama_bisnis : '' }}"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="nama_bisnis"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nama
                Bisnis</label>
        </div>
    
        <!-- Alamat -->
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="alamat" id="alamat"
                value="{{ isset($info_bisnis[0]) ? $info_bisnis[0]->alamat : '' }}"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="alamat"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Alamat</label>
        </div>
    
        <!-- Jabatan -->
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="jabatan" id="jabatan"
                value="{{ isset($info_bisnis[0]) ? $info_bisnis[0]->jabatan : '' }}"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="jabatan"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Jabatan</label>
        </div>
    
        <!-- No Tax -->
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="no_tax" id="no_tax"
                value="{{ isset($info_bisnis[0]) ? $info_bisnis[0]->no_tax : '' }}"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " />
            <label for="no_tax"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tax
                No</label>
        </div>
    
        <!-- Website & Email -->
        <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="website" id="website"
                    value="{{ isset($info_bisnis[0]) ? $info_bisnis[0]->website : '' }}"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="website"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Website</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="email" id="email"
                    value="{{ isset($info_bisnis[0]) ? $info_bisnis[0]->email : '' }}"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="email"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Alamat
                    Email</label>
            </div>
        </div>
    
        <!-- Logo & No Handphone -->
        <div class="grid md:grid-cols-2 md:gap-6 items-end">
            <div>
                <img id="avatar" class="w-20 h-20 rounded mb-3" src="{{ isset($info_bisnis[0]) ? 'storage/' . $info_bisnis[0]->logo : 'image/logo/placeholder_logo.png' }}"
                        alt="Logo">
                <input type="hidden" name="oldLogo" value="{{ isset($info_bisnis[0]) ? $info_bisnis[0]->logo : ''}}">
                
                <input onchange="previewImageLogo()" id="logoImage" name="logo"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="file_input_help" id="file_input" type="file">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF</p>
            </div>
    
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="no_handphone" id="no_handphone"
                    value="{{ isset($info_bisnis[0]) ? $info_bisnis[0]->no_handphone : ''}}"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " required />
                <label for="no_handphone"
                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">No
                    Handphone</label>
            </div>
        </div>
    
        <button type="submit"
            class="text-white mt-3 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
    </form>
    

</div>
    <script>
    
        const logoImage = document.getElementById('logoImage')    
        const avatar = document.getElementById('avatar')
        const previewImageLogo = () => {
        const file = logoImage.files[0]; // Mengambil file dari input
            if (file) {
            const imageUrl = URL.createObjectURL(file); // Membuat URL objek dari file
            avatar.src = imageUrl; // Menampilkan gambar dalam elemen img
            // dropzoneTailwind.classList.add('hidden');
            // hapusButton.classList.remove('hidden');
            // simpanGambar.disabled = false;
            }
        }
    </script>
@endsection

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\informasiBisnis;
use App\Models\Kategori_anggaran;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.register.index');
    }


    public function showUser()
    {
        $user = User::with('payment')->paginate(15);
        $role = Role::all();
        return view('dashboard.admin.user.index', [
            'user' => $user,
            'role' => $role
        ]);
    }


    public function actionShowUser()
    {
        switch (request()->id) {
            case 'asc':
                $user = User::orderBy('username', 'asc')->paginate(15);
                break;
            case 'dsc':
                $user = User::orderBy('username', 'desc')->paginate(15);
            case 'tanggal':
                $user = User::orderBy('created_at', 'asc')->paginate(15);
            default:
                $user = User::paginate(15);
                break;
        }
        return view('dashboard.admin.user.index', [
            'user' => $user
        ]);
    }

    public function giveRole()
    {
        $user = User::find(request()->id);

        $user->assignRole(request()->user_role);

        return redirect('/user');
    }

    public function removeRole()
    {
        $user = User::find(request()->id);

        $user->removeRole('admin');

        return redirect('/user');
    }

    public function createUserByAdmin()
    {
        $validate = request()->validate([
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'user_role' => 'required',
            'password' =>'required',
        ], [
            'username.required' => 'Kolom username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Kolom password wajib diisi.',
        ]);

        if($validate['password'] === request()->confirm_password){
            $validate['password'] = bcrypt($validate['password']);


            $user = User::create($validate);

            $user->assignRole(request()->user_role);

            // if($validate['user_role'] == 'admin') {
            //     $user->assignRole('admin');
            // }

            return redirect('/user');
        }

    }

    public function deleteUserByAdmin()
    {
        $credentials = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Menyimpan ID pengguna saat ini sebelum mencoba otentikasi
        $currentUserId = auth()->id();

        if (Auth::attempt($credentials)) {
            // Nonaktifkan otentikasi sementara
            auth()->logout();

            // Hapus pengguna
            User::destroy(request()->id);

            // Jika pengguna saat ini tidak sama dengan pengguna yang dihapus, login kembali
            if ($currentUserId != request()->id) {
                auth()->loginUsingId($currentUserId);
            }

            return redirect('/user');
        } else {
            return redirect('/user')->with('password_error', 'Password yang Anda masukkan salah');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validate = $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' =>'required',
        ], [
            'username.required' => 'Kolom username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Kolom email wajib diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Kolom password wajib diisi.',
        ]);

        if($validate['password'] === request('confirm-password')){
            $validate['password'] = bcrypt($validate['password']);

            $user = User::create($validate);

            event(new Registered($user));
            Auth::login($user);


            $kategoriAnggaran = [
                ['nama' => 'kebutuhan', 'value' => 50, 'user_id' => auth()->user()->id],
                ['nama' => 'keinginan', 'value' => 30, 'user_id' => auth()->user()->id],
                ['nama' => 'tabungan', 'value' => 20, 'user_id' => auth()->user()->id],
            ];

            Kategori_anggaran::insert($kategoriAnggaran);

            return redirect('/email/verify');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = User::where('id', auth()->user()->id)->get();
        return view('user.profile.index', [
            'user' => $user[0],
            'info_bisnis' => informasiBisnis::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {


        $validate = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'username' => 'required',
            'no_handphone' => 'required',
        ]);

        if ($request->file('profile-image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
             // upload ke server cloud [CDN]
             $validate['foto'] = cloudinary()->upload(request()->file('profile_image')->getRealPath())->getSecurePath();
        }
        User::where('id', auth()->user()->id)->update($validate);
        return redirect('/profile');
    }

    public function storeImage()
    {
        $validate = request()->validate([
            'foto' => 'image|file|max:2048'
        ]);

        if (request()->hasFile('profile_image')) {
            if (request()->oldImage) {
                Storage::delete(request()->oldImage);
            }
            // upload ke lokal
            // $validate['foto'] = request()->file('profile_image')->storeAs('profile-images', uniqid() . '-' . request()->file('profile_image')->getClientOriginalName());

            // upload ke server cloud [CDN]
            $validate['foto'] = cloudinary()->upload(request()->file('profile_image')->getRealPath())->getSecurePath();
        }

        User::where('id', auth()->user()->id)->update($validate);
        return redirect('/profile');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
    }

    public function deleteImage()
    {
        Storage::delete(request()->image);

        DB::table('users')
            ->where('id', auth()->user()->id)
            ->update(['foto' => null]);

    }
}

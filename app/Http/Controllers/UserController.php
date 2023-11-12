<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
        return view('dashboard.admin.user.index', [
            'user' => User::all()
        ]);
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
            
            User::create($validate);

            return redirect('/');
        }
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user = User::where('id', auth()->user()->id)->get();
        return view('user.profile.index', [
            'user' => $user[0]
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

        if($request->file('profile-image')){
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validate['foto'] = request()->file('profile-image')->store('profile-images');
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
            $validate['foto'] = request()->file('profile_image')->storeAs('profile-images', uniqid() . '-' . request()->file('profile_image')->getClientOriginalName());
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

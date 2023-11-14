<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\informasiBisnis;
use Illuminate\Support\Facades\Storage;

class informasiBisnisController extends Controller
{
    public function store()
    {
        $validate = request()->validate([
            'nama_bisnis' => 'required',
            'alamat' => 'required',
            'jabatan' => 'required',
            'no_tax' => 'max:255',
            'website' => 'max:255',
            'email' => 'required',
            'no_handphone' => 'required',
        ]);
        $validate['user_id'] = auth()->user()->id;

        if(request()->file('logo')){
            if(request()->oldLogo) {
                Storage::delete(request()->oldLogo);
            }
            $validate['logo'] = request()->file('logo')->store('logo_bisnis');
        }

        if(informasiBisnis::where('user_id', auth()->user()->id)->get() != null){
            informasiBisnis::where('user_id', auth()->user()->id)->update($validate);
        }else{
            informasiBisnis::create($validate);
        }


        return redirect('/profile');
    }
}

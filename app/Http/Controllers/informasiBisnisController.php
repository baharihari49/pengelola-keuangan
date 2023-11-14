<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\informasiBisnis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Menambahkan validasi untuk gambar
        ]);
        
        $validate['user_id'] = auth()->user()->id;
        
        if(request()->file('logo')){
            if(request()->oldLogo) {
                // Pastikan oldLogo berisi path lengkap ke file
                Storage::delete(request()->oldLogo);
            }
            $validate['logo'] = request()->file('logo')->store('logo_bisnis');
        }
        
        $infoBisnis = informasiBisnis::where('user_id', auth()->user()->id)->first();
        
        if($infoBisnis){
            $infoBisnis->update($validate);
        }else{
            informasiBisnis::create($validate);
        }
        
        return redirect('/profile');
    
    }

    public function deleteLogo()
    {
        Storage::delete(request()->logo);

        DB::table('informasi_bisnis')
            ->where('id', auth()->user()->id)
            ->update(['logo' => null]);

        return redirect('/profile');
    }

}

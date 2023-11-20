<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class aksesLevelController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.aksesLevel.index', [
            'data' => Role::all()
        ]);
    }

    public function store()
    {
        Role::create(['name' => request()->name]);
        return redirect('/akses_level');
    }

    public function update()
    {
        Role::where('name', request()->oldName)->update(['name' => request()->name]);
        return redirect('/akses_level');
    }

    public function delete()
    {
        Role::destroy(request()->name);
        return redirect('/akses_level');
    }

    public function editAksesLevel()
    {
        return view('dashboard.admin.aksesLevel.layouts.editAksesLevel.index', [
            'user' => User::where('id', auth()->user()->id)->get()[0]
        ]);
    }
}

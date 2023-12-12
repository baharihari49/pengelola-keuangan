<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

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
        $user = Role::where('id', request()->id)->first();

        // $directPermissions = $user->getAllPermissions();
        // return $directPermissions;


        $rolePermissions = $user->getAllPermissions()->pluck('name')->toArray();


        // return $rolePermissions;
        return view('dashboard.admin.aksesLevel.layouts.editAksesLevel.index', [
            'user' => User::where('id', auth()->user()->id)->get()[0],
            'data' => Role::where('id', request()->id)->get()[0],
            'rolePermissions' => $rolePermissions,
        ]);
    }

    // public function editPermission(Request $request)
    // {
        // $role = Role::where('name', 'Super Admin')->first();
        // // Ambil izin yang sudah ada pada role
        // $existingPermissions = $role->permissions->pluck('name')->toArray();

    //     // Ambil nama-nama izin yang dikirim melalui checkbox
    //     $requestedPermissions = $request->input('permission', []);

    //     $permissionsToAdd = array_diff($requestedPermissions, $existingPermissions);

    //     // Berikan izin pada role untuk izin baru yang dicentang
    //     foreach ($permissionsToAdd as $permissionName) {
    //         $permission = Permission::firstOrCreate(['name' => $permissionName]);
    //         $role->givePermissionTo($permission);
    //     }

    //     return redirect()->back()->with('success', 'Izin berhasil diberikan.');
    // }


    public function editPermission(Request $request)
    {
        $role = Role::where('id', request()->id)->first();

        // return request();


        // Ambil izin yang sudah ada pada role
        $existingPermissions = $role->permissions->pluck('name')->toArray();


        // Ambil nama-nama izin yang dikirim melalui checkbox

        $requestedPermissions = $request->input('permission', []);

        // Izin yang perlu dihapus
        $permissionsToRemove = array_diff($existingPermissions, $requestedPermissions);

        // Izin yang perlu ditambahkan
        $permissionsToAdd = array_diff($requestedPermissions, $existingPermissions);

        // Hapus izin yang tidak dicentang
        foreach ($permissionsToRemove as $permissionName) {
            $permission = Permission::where('name', $permissionName)->first();
            if ($permission) {
                $role->revokePermissionTo($permission);
            }
        }

        // Berikan izin untuk izin baru yang dicentang
        foreach ($permissionsToAdd as $permissionName) {
            $permission = Permission::firstOrCreate(['name' => $permissionName]);
            $role->givePermissionTo($permission);
        }

        return redirect()->back()->with('success', 'Izin berhasil diperbarui.');
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // dd(User::with('permissions', 'roles', 'division')->get());
        return view('super-user.user', [
            'getUsers' => User::with('permissions', 'roles', 'employee')->get()
        ]);
    }


    public function edit(User $user)
    {
        return view('super-user.edit', [
            'users' => $user,
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }
    public function update(User $user, Request $request)
    {

        if ($request->roles) {
            $user->roles()->detach();
            foreach ($request->roles as $value) {
                $user->assignRole($value);
            };
        }

        if ($request->permissions) {
            $user->permissions()->detach();
            foreach ($request->permissions as $value) {
                $user->assignRole($value);
            };
        }

        return redirect()->route('su.user.index')->with('green', 'Data Berhasil Diubah');
    }
}

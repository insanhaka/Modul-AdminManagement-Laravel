<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;

class UsersController extends Controller
{

    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.Profile.index', ['data' => $user]);
    }

    public function index()
    {
        return view('Admin.Settings.index');
    }

    public function view()
    {
        $users = User::all();
        return view('Admin.Users.index', ['data' => $users]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Roles::all();
        return view('Admin.Users.edit', ['data' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        $roles_id = $request->roles_id;

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $role = Roles::findOrFail($roles_id);
        $user->syncRoles($role->name);
        $user->roles_id = $roles_id;
        $process = $user->save();

        if ($process) {
            return redirect(url('/admin/user/view'))->with('updated','Data Berhasil Disimpan');
        } else {
            return back()->with('error','Data Gagal Disimpan');
        }

        // bcrypt($request->password)
    }

    public function delete($id)
    {
        $user = User::find($id);
        $process = $user->delete();

        if ($process) {
            return redirect(url('/admin/user/view'))->with('deleted','Data Berhasil Dihapus');
        } else {
            return back()->with('error','Data Gagal Dihapus');
        }
    }

    public function activation(Request $request)
    {
        $id = $request->id;
        // dd($id);

        $user = User::findOrFail($id);
        $user->is_active = $request->is_active;
        
        $process = $user->save();
    }

}

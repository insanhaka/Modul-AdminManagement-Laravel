<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permissions;
use Spatie\Permission\Models\Permission;
use App\Models\Roles;
use Spatie\Permission\Models\Role;
use App\Models\Menu;
use Illuminate\Support\Str;


class PermissionController extends Controller
{
    public function view()
    {
        $permissions = Permission::all();
        return view('Admin.Permission.index', ['data' => $permissions]);
    }

    public function add()
    {
        $menus = Menu::all();
        $roles = Roles::all();
        return view('Admin.Permission.create', ['data' => $menus, 'role' => $roles]);
    }

    public function create(Request $request)
    {
        $role = Role::findOrFail($request->role_id);

        foreach($request->permission as $data)
        {
            $get_menu = Str::between($data, '/', '/');
            $menu_id = Menu::where('name', $get_menu)->first();
            Permission::create([
                'name' => $role->name.':'.$data,
                'menu_id' => $menu_id->id
            ]);
        }

        foreach($request->permission as $data)
        {
            $role->givePermissionTo($role->name.':'.$data);
        }

        return redirect(url('/admin/user/permission'))->with('created','Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $permission = Permissions::findOrFail($id);
        return view('Admin.Permission.edit', ['data' => $permission]);
    }

    public function update(Request $request, $id)
    {
        $name = Str::lower($request->name);
        $permission = Permissions::findOrFail($id);
        $permission->name = $name;
        $process = $permission->save();

        if ($process) {
            return redirect(url('/admin/user/permission'))->with('updated','Data Berhasil Disimpan');
        } else {
            return back()->with('warning','Data Gagal Disimpan');
        }
    }

    public function delete($id)
    {
        $permission = Permissions::find($id);
        $process = $permission->delete();

        if ($process) {
            return redirect(url('/admin/user/permission'))->with('deleted','Data Berhasil Dihapus');
        } else {
            return back()->with('warning','Data Gagal Dihapus');
        }
    }
}

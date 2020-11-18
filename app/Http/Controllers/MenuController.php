<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function view()
    {
        $menus = Menu::all();
        return view('Admin.Menu.index', ['data' => $menus]);
    }

    public function add()
    {
        $menus = Menu::where('menu_type', 'parent')->get();
        return view('Admin.Menu.create', ['data' => $menus]);
    }

    public function create(Request $request)
    {
        $create = new Menu;
        $create->name = $request->name;
        $create->uri = $request->uri;
        $create->is_active = $request->is_active;
        $create->menu_type = $request->menu_type;
        $create->menu_group = $request->menu_group;

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('gambar');
        if($file == null){
            $nama_file = "";
            $create->icon = $nama_file;
        }else{
            $nama_file = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'menus_icon';
            $file->move($tujuan_upload,$nama_file);
            $create->icon = $nama_file;
        }

        $create->save();
        return redirect(url('/admin/user/menu'))->with('created','Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $menus = Menu::findOrFail($id);
        return view('Admin.Menu.edit', ['data' => $menus]);
    }

    public function update(Request $request, $id)
    {
        $file = $request->file('gambar');

        $menus = Menu::findOrFail($id);

        if($file == null){
            $menus->name = $request->name;
            $menus->uri = $request->uri;
            $menus->is_active = $request->is_active;
            $process = $menus->save();
            if ($process) {
                return redirect(url('/admin/user/menu'))->with('updated','Data Berhasil Disimpan');
            } else {
                return back()->with('warning','Data Gagal Disimpan');
            }
        }else{
            $nama_file = time()."_".$file->getClientOriginalName();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'menus_icon';
            $file->move($tujuan_upload,$nama_file);
            $menus->name = $request->name;
            $menus->uri = $request->uri;
            $menus->is_active = $request->is_active;
            $menus->icon = $nama_file;
            $process = $menus->save();
            if ($process) {
                return redirect(url('/admin/user/menu'))->with('updated','Data Berhasil Disimpan');
            } else {
                return back()->with('warning','Data Gagal Disimpan');
            }
        }

    }

    public function delete($id)
    {
        $menu = Menu::find($id);
        $process = $menu->delete();

        if ($process) {
            return redirect(url('/admin/user/menu'))->with('deleted','Data Berhasil Dihapus');
        } else {
            return back()->with('warning','Data Gagal Dihapus');
        }
    }

    public function activation(Request $request)
    {
        $id = $request->id;
        // dd($id);

        $menus = Menu::findOrFail($id);
        $menus->is_active = $request->is_active;

        $process = $menus->save();
    }
}

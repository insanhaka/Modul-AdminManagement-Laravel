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
        return view('Admin.Menu.create');
    }

    public function create(Request $request)
    {
        $create = new Menu;
        $create->name = $request->name;
        $create->uri = $request->uri;
        $create->is_active = $request->is_active;

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
}

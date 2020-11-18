<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Roles;
use App\Models\Permissions;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use DB;

class MenuLib
{

    public static function getRole($role)
    {
        $get_role = Roles::where('name', $role)->first();
        $role_id = $get_role->id;

        $permission_id = DB::table('role_has_permissions')
                        ->where('role_id', $role_id)
                        ->select('permission_id')
                        ->get();

        foreach ($permission_id as $value) {
            $get_id = $value->permission_id;
            $id = Permissions::where('id', $get_id)->first();
            $menu_id[] = $id->menu_id;
        }

        $user_menu = array_unique($menu_id);
        // $prefix = str_replace('/','',\Request::route()->getPrefix());
        $menus = Menu::find($user_menu);

        $menu_group_id = [];
        foreach($menus as $item)
        {
            $menu_group_id[] = $item->menu_group;
        }
        $menu_group = array_unique($menu_group_id);

        $child_menus = [];
        foreach($menus as $val){
            $menu_name = $val->name;
            $menu_uri = '/admin'.$val->uri;
            $menu_icon = $val->icon;
            $menuID = Str::after($val->uri, '/');
            $exists = Arr::exists($menu_group, $val->id);
            if ($val->menu_type === "child" ) {
                $child_menus[] = '<li class="nav-item">
                                    <a class="nav-link" href="'.$menu_uri.'" id="'.$menuID.'">
                                        <img src="/menus_icon/'.$menu_icon.'" width="15" style="margin-right: 20px;">
                                        <span class="nav-link-text">'.$menu_name.'</span>
                                    </a>
                                </li> ' ;
            }
        }

        $child_menu = implode($child_menus);

        foreach($menus as $data_menu)
        {
            $menu_name = $data_menu->name;
            $menu_uri = '/admin'.$data_menu->uri;
            $menu_icon = $data_menu->icon;
            $menuID = Str::after($data_menu->uri, '/');
            $exists = Arr::exists($menu_group, $data_menu->id);

            if ($exists == true ) {

                $html_out = '<li class="nav-item">
                                <a class="nav-link" href="#'.$menuID.'" id="'.$menuID.'" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-examples">
                                    <img src="/menus_icon/'.$menu_icon.'" width="15" style="margin-right: 20px;">
                                    <span class="nav-link-text">'.$menu_name.'</span>
                                </a>
                                <div class="collapse" id="'.$menuID.'">
                                    <ul class="nav nav-sm flex-column">
                                        '.$child_menu.'
                                    </ul>
                                </div>
                            </li>' ;

                echo $html_out;
            }

            if ($exists == false && $data_menu->menu_type === "parent") {
                $html_out = '<li class="nav-item">
                                <a class="nav-link" href="'.$menu_uri.'" id="'.$menuID.'">
                                    <img src="/menus_icon/'.$menu_icon.'" width="15" style="margin-right: 20px;">
                                    <span class="nav-link-text">'.$menu_name.'</span>
                                </a>
                            </li> ' ;

                echo $html_out;
            }

        }

    }
}

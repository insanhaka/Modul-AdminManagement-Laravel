<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class ApiController extends Controller
{
    
    public function datauser()
    {
        $user = DB::table('users')
                ->select('name', 'username', 'email')
                ->get();

        return response()->json([
            'datausers' => $user,
        ]);
    }

    // public function signup(Request $request)
    // {
    //     // dd($request->username);

    //     $signup = new User;
    //     $signup->name = $request->name;
    //     $signup->username = $request->username;
    //     $signup->email = $request->email;
    //     $signup->password = bcrypt($request->password);
    //     $signup->is_active = $request->is_active;

    //     $signup->save();
    // }

}

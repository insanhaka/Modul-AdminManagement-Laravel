<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class AuthorizeController extends Controller
{
    public function login()
    {
    	return view('Auth.login');
    }

    public function postlogin(Request $request)
    {
        
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password]))
        {
            $user = User::where('username', $request->username)->first();
            $user_activation =  $user->is_active;

            if ($user_activation == 1)
            {
                return redirect()->route('home');
            }
            else
            {
                return redirect()->route('notactive');
            }
        }
        else
        {
            return redirect()->route('login')
            ->with('error','Email/Password yang anda masukan salah');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function signup()
    {
        return view('Auth.register');
    }

    public function notactive()
    {
    	return view('Auth.activation');
    }

    public function hapusadmin(Request $request)
    {
        $admin = User::find($request->id);
        $admin->delete();
        return redirect()->route('pengaturan');
    }
}

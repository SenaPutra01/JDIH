<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function submit(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:30',
            'password' => 'required|max:30'
        ]);

        $user = User::where('username', $request->username)
                  ->where('password', md5($request->password))
                  ->first();

        if (!$user){
            $validator->errors()->add('user', 'Username atau password tidak ditemukan.');
        }else{
            if($user->state_active != 1){
                $validator->errors()->add('user', 'Akun pengguna sudah tidak aktif.');
            }else{
                Auth::login($user, $request->remember);
                return redirect(route('dashboard'));
            }
        }
        
        return redirect(Route('login'))
            ->withErrors($validator)
            ->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}

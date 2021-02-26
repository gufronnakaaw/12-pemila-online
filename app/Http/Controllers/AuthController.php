<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function checkLogin(Request $request){
        $request->validate([
            'email_username_login' => 'required',
            'password_login' => 'required'
        ]);
        
        $user = User::where('email', $request->email_username_login)
                ->orWhere('username', $request->email_username_login)->first();
        
        if($user){

            if( Hash::check($request->password_login, $user->password) ) {
                
                $data = [
                    'id_user' => $user->id,
                    'username' => $user->username,
                    'img' => $user->img,
                    'role' => $user->role
                ];
                
                $request->session()->put('loggedUser', $data);

                if( $user->role === 'admin'){
                    return redirect('/dashboard');
                } else if( $user->role === 'user' ){
                    return redirect('/');
                }

            } else {
                return redirect('/login')->with('fail', 'Wrong password!');
            }

        } else {
             return redirect('/login')->with('fail', 'Email or username not found!');
        }
    }

    public function logout(){
        if( session()->has('loggedUser') ){
            session()->pull('loggedUser');
            return redirect('/login');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Laptop;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard(){
        $data = [
            'total_laptops' => Laptop::all()->count(),
            'used_laptops' => Laptop::where('status', 'used')->get()->count(),
            'unused_laptops' => Laptop::where('status', 'unused')->get()->count(),
            'total_users' => User::where('role', 'user')->count(),
            'orders' => Order::all()
        ];
        return view('dashboard.index', compact('data'));
    }

    public function profile(User $user){
        return view('dashboard.administrator.profile', compact('user'));
    }
    
    public function settings(User $user){

        return view('dashboard.administrator.settings', compact('user'));
    }
    
    public function users(){
        $users = User::where('role', 'user')->get();
        return view('dashboard.administrator.user.users', compact('users'));
    }

    public function create(){
        return view('dashboard.administrator.user.createUser');
    }

    public function update(Request $request){
        $request->validate([
            'edit_username_admin' => 'required',
            'edit_img_admin' => 'mimes:jpg,jpeg,png|max:1024'
        ]);

        
        if( $request->hasFile('edit_img_admin') ){
            
            $oldUser = User::where('id', $request->id_user)->first();

            if( $oldUser->username === $request->edit_username_admin ){

                $imgName = Str::random(10) . '-' . $request->file('edit_img_admin')->getClientOriginalName();

                $request->file('edit_img_admin')->move(public_path('img/admin'), $imgName);

                $user = User::where('id', $request->id_user)->update([
                    'img' => $imgName
                ]);
                
                if( $user ){
                    
                    $data = [
                        'id_user' => $request->id_user,
                        'username' => $request->edit_username_admin,
                        'img' => $imgName
                    ];
                    
                    $request->session()->put('loggedUser', $data);
                    return redirect("/settings" . '/' . $request->session()->get('loggedUser')['username'])->with('success', 'Update successfully!');
    
                } else {
                    return redirect("/settings" . '/' . $request->session()->get('loggedUser')['username'])->with('fail', 'Cannot update data!');
                }

            } else {

                $imgName = Str::random(10) . '-' . $request->file('edit_img_admin')->getClientOriginalName();

                $request->file('edit_img_admin')->move(public_path('img/admin'), $imgName);

                $user = User::where('id', $request->id_user)->update([
                    'username' => $request->edit_username_admin,
                    'img' => $imgName
                ]);
                
                if( $user ){
                    
                    $data = [
                        'id_user' => $request->id_user,
                        'username' => $request->edit_username_admin,
                        'img' => $imgName
                    ];
                    
                    $request->session()->put('loggedUser', $data);
                    return redirect("/settings" . '/' . $request->session()->get('loggedUser')['username'])->with('success', 'Update successfully!');
    
                } else {
                    return redirect("/settings" . '/' . $request->session()->get('loggedUser')['username'])->with('fail', 'Cannot update data!');
                }
            }
            
        } else {

            $oldUser = User::where('username', $request->edit_username_admin)->get();

            if( $oldUser->isEmpty() ){
            
                $user = User::where('id', $request->id_user)->update([
                    'username' => $request->edit_username_admin
                ]);
                
                if( $user ){
                    
                    $data = [
                        'id_user' => $request->id_user,
                        'username' => $request->edit_username_admin,
                        'img' => $request->session()->get('loggedUser')['img']
                    ];
                    
                    $request->session()->put('loggedUser', $data);
                    return redirect("/settings" . '/' . $request->session()->get('loggedUser')['username'])->with('success', 'Update successfully!');
    
                } else {
                    return redirect("/settings" . '/' . $request->session()->get('loggedUser')['username'])->with('fail', 'Cannot update data!');
                }
        
            } else {
                return redirect("/settings" . '/' . $request->session()->get('loggedUser')['username'])->with('fail', 'Username already exists');
            }

        }

    }

    public function store(Request $request){
        
        $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'img' => 'default.jpg',
            'created_at' => now(),
        ]);
        
        if($user){
            return redirect('/users')->with('success', 'Create user successfully!');
        } else {
            return redirect('/users')->with('fail', 'Create user successfully!');
        }
    }

    public function edit(User $user){
        return view('dashboard.administrator.user.editUser', compact('user'));
    }

    public function updateUser(Request $request){
        $request->validate([
            'edit_username_user' => 'required',
            'edit_img_user' => 'mimes:jpg,jpeg,png|max:1024'
        ]);

        
        if( $request->hasFile('edit_img_user') ){
            
            $oldUser = User::where('id', $request->id_user)->first();

            if( $oldUser->username === $request->edit_username_user ){

                $imgName = Str::random(10) . '-' . $request->file('edit_img_user')->getClientOriginalName();

                $request->file('edit_img_user')->move(public_path('img/user'), $imgName);

                $user = User::where('id', $request->id_user)->update([
                    'img' => $imgName
                ]);
                
                if( $user ){

                    return redirect("/users")->with('success', 'Update successfully!');
    
                } else {

                    return redirect("/users/edit/$request->id_user")->with('fail', 'Cannot update data!');
                    
                }

            } else {

                $imgName = Str::random(10) . '-' . $request->file('edit_img_user')->getClientOriginalName();

                $request->file('edit_img_user')->move(public_path('img/user'), $imgName);

                $user = User::where('id', $request->id_user)->update([
                    'username' => $request->edit_username_user,
                    'img' => $imgName
                ]);
                
                if( $user ){
                    
                    return redirect("/users")->with('success', 'Update successfully!');
    
                } else {
                    
                    return redirect("/users/edit/$request->id_user")->with('fail', 'Cannot update data!');
                    
                }
            }
            
        } else {

            $oldUser = User::where('username', $request->edit_username_user)->get();

            if( $oldUser->isEmpty() ){
            
                $user = User::where('id', $request->id_user)->update([
                    'username' => $request->edit_username_user
                ]);
                
                if( $user ){

                    return redirect("/users")->with('success', 'Update successfully!');
    
                } else {

                    return redirect("/users/edit/$request->id_user")->with('fail', 'Cannot update data!');
                    
                }
        
            } else {
                return redirect("/users/edit/$request->id_user")->with('fail', 'Username already exists');
            }

        }

    }

    public function destroy(User $user){
        if( User::destroy($user->id) ){
            return redirect('/users')->with('success', 'Delete successfully');
        }

        return redirect('/users')->with('fail', 'Cannot delete users!');
    }
}
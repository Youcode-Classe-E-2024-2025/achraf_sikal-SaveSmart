<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect("/");
    }
    public function signup(Request $request){
        if($request->method()=="POST"){
            $incomingFields = $request->validate([
                'name'=> ['required','min:3','max:25',Rule::unique('users','name')],
                'email'=> ['required','email',Rule::unique('users','email')],
                'password'=> ['required','min:8','max:200'],
                'avatar'=> ['required'],
            ]);
            if ($request->hasFile('avatar')) {
                $incomingFields['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }
            $incomingFields['password'] = bcrypt($incomingFields['password']);
            $user = User::create($incomingFields);
            auth()->login($user);
            return redirect('/')->with('success', 'Account created successfully!');
        }
        return view('user/signup');
    }
    public function login(Request $request){
        if($request->method()=="POST"){
            $incomingFields = $request->validate([
                'email'=> ['required'],
                'password'=> ['required'],
            ]);
            if(auth()->attempt($incomingFields)){
                $request->session()->regenerate();
                return redirect('/');
            }
        }
        return view('user/login');
    }
    public function profile(Request $request){
        $user = auth()->user();
        return view('user/profile',compact('user'));
    }
}

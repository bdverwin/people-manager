<?php

namespace App\Services\AuthServices;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthService implements AuthManager {

    public function login(array $data){

        $user = User::where('email', $data['email'])->first();

        if(!$user || ! Hash::check($data['password'], $user->password)){
            return null;
        }

        Auth::login($user);
        
        return $user;
    }

    public function register(array $data){
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Auth::login($user);
    }

    public function logout(){
        Auth::logout();
    }
}
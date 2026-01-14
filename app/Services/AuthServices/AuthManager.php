<?php

namespace App\Services\AuthServices;


interface AuthManager{

    public function login(array $data);
    
    public function register(array $data);

    public function logout();

}
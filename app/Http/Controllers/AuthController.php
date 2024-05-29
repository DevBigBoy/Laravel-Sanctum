<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login()
    {
        return 'This This my Login Method......';
    }

    public function register()
    {
        return response()->json('This is my Register Method....');
    }

    public function logout()
    {
        return response()->json('This is my Logout Method.....');
    }
}
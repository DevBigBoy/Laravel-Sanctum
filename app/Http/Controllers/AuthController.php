<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\storeUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login()
    {

        return 'This This my Login Method......';
    }

    public function register(storeUserRequest $request)
    {
        // $request->validated($request->all());

        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API Token of' . $user->name)->plainTextToken,
        ]);
    }

    public function logout()
    {
        return response()->json('This is my Logout Method.....');
    }
}
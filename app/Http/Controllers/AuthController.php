<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\LoginUserRequest;
use App\Http\Requests\API\storeUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();

        $validated = $request->safe()->only(['email', 'password']);

        if (!Auth::attempt($validated)) {
            return $this->error('', 'Credentials do not match', 401);
        }

        $user = User::where('email', $validated['email'])->first();

        return $this->success(
            [
                'user' => $user,
                'token' => $user->createToken('Api Token of' . $user->name)->plainTextToken
            ]
        );
    }

    public function register(storeUserRequest $request)
    {
        $request->validated($request->all());

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
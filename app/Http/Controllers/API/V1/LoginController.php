<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request, UserService $userService)
    {
        if (Auth::attempt([
            'email' => $request->validated()['email'],
            'password' => $request->validated()['password']
        ])) {
            $token = $userService->generateToken(Auth::user());
            return response()->outputOk(['token'=>$token]);
        } else {
            return response()->outputError("Invalid username or password");

        }
    }
}

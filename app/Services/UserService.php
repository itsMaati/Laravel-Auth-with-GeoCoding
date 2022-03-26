<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class UserService  {

    public function registerUser(array $input, string $location)
    {
        if (RateLimiter::tooManyAttempts('register '.request()->ip(), $perMinute = 1)) {
            throw new TooManyRequestsHttpException();
        }

        RateLimiter::hit('register '.request()->ip());

        return User::create([
            'first_name'=>$input['first_name'],
            'last_name'=>$input['last_name'],
            'email'=>$input['email'],
            'password'=>Hash::make($input['password']),
            'city_name'=>$input['city'],
            'city_coordinates'=>$location,
        ]);
    }
    public function generateToken(User $user)
    {
        return $user->createToken(date("Y-m-d H:i:s")." Login with web")->plainTextToken;
    }

}

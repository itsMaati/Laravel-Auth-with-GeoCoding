<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService  {

    public function registerUser(array $input, string $location)
    {
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

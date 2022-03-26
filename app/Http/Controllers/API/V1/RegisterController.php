<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $response = Http::post('http://example.com/users', [
            'name' => 'Steve',
            'role' => 'Network Administrator',
        ]);
    }
}

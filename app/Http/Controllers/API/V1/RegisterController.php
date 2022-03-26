<?php

namespace App\Http\Controllers\API\V1;

use App\Exceptions\Geo\GeoServiceUnavailableException;
use App\Exceptions\Geo\LocationNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\RegisterRequest;
use App\Models\User;
use App\Models\UserLocation;
use App\Services\GeocodingInterface;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Nette\IOException;

class RegisterController extends Controller
{
    /**
     * Resolves the coordinates of user's city and then registers the user in database
     *
     * @param RegisterRequest $request
     *
     * @param UserService $userService
     *
     * @param GeocodingInterface $geoService
     *
     * @return Response
     *
     */
    public function store(RegisterRequest $request, UserService $userService, GeocodingInterface $geoService)
    {
        $locationGeocoded = $geoService->getCityCoordinates($request->validated()['city']);

        $user = $userService->registerUser($request->validated(),$locationGeocoded);

        $token = $userService->generateToken($user);

        return response()->outputOk(['token'=>$token]);
    }
}

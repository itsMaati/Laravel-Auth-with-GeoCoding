<?php

namespace App\Services;

use App\Exceptions\Geo\GeoServiceUnavailableException;
use App\Exceptions\Geo\LocationNotFoundException;
use Illuminate\Support\Facades\Http;

class MapboxGeocodingService implements GeocodingInterface {
    /**
     * @inheritdoc
     */
    public function getCityCoordinates(string $cityName) : string
    {
        $response = Http::get('https://api.mapbox.com/geocoding/v5/mapbox.places/'.urlencode($cityName).'.json', [
            "country"=>"ir",
            "types"=>"region,locality,address,district,neighborhood",
            "access_token"=>env("MAPBOX_TOKEN"),
        ]);

        if($response->failed()){
            throw new GeoServiceUnavailableException();
        }

        $body = json_decode($response->body(),true);

        if(count($body['features']) === 0) {
            throw new LocationNotFoundException();
        }

        return json_encode(array_values($body['features'][0]['center']));
    }
}

<?php

namespace App\Services;


interface GeocodingInterface
{
    /**
     * Resolves the coordinates of a given city
     * @param string $cityName
     *
     * @return string
     */
    public function getCityCoordinates(string $cityName) : string;

}

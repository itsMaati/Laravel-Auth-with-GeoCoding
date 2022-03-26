<?php

namespace App\Services;


interface GeocodingInterface
{
    public function getCityCoordinates(string $name) : string;

}

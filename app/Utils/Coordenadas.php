<?php

namespace App\Utils;

class Coordenadas
{
    public static function getCoordenadas($address){
        $address = urlencode($address);
        $url = "https://maps.google.com/maps/api/geocode/json?key=".config('app.env_variables.APP_GOOGLE_MAPS_API_KEY')."&sensor=true&address=" . $address;
        $response = file_get_contents($url);
        $json = json_decode($response,true);

        if ($json['status'] == 'ZERO_RESULTS') {
            return array(0,0);
        }

        $lat = $json['results'][0]['geometry']['location']['lat'];
        $lng = $json['results'][0]['geometry']['location']['lng'];

        return array($lat, $lng);
    }

}

<?php

class City {

    public static function getEgyptianCities() {
        $cities = json_decode(file_get_contents("./assets/city.list.json"), true);
        return array_filter($cities, function($city) {
            return $city['country'] === 'EG';
        });
    }
}
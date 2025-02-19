<?php

namespace App;

use Cmfcmf\OpenWeatherMap;
use Exception;

class Forecast
{
    public function apiResponse($httpClient, $httpRequestFactory, $city)
    {
        try{
            $owm = new OpenWeatherMap('8e24ae3eb21d77517de7adea94909335', $httpClient, $httpRequestFactory);
            $weather = $owm->getWeather($city, 'metric', 'ru');
            return $weather;
        } catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function forecastResponse($httpClient, $httpRequestFactory, $city)
    {
        try {
            $owm = new OpenWeatherMap('8e24ae3eb21d77517de7adea94909335', $httpClient, $httpRequestFactory);
            $weather = $owm->getWeatherForecast($city, 'metric', 'ru', '', 1);
            return $weather;
        } catch(Exception $e){
            return $e->getMessage();
        }

    }

    public function getCities()
    {
        $url = __DIR__ . '/cities.json';
        $json = file_get_contents($url);
        $cities = null;
        try {
            $cities = json_decode($json, true);
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        return $cities;
    }
}

?>
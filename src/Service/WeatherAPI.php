<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class WeatherAPI
{

    public function __construct()
    {
    }
    public function getWeather(HttpClientInterface $client): string
    {

        $response = $client->request('GET', 'https://api.open-meteo.com/v1/forecast?latitude=52.52&longitude=13.41&hourly=temperature_2m');
        dd($response);
    }
}

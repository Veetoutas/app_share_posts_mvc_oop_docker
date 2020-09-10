<?php


namespace VFramework\Controllers;


use VFramework\Api\CitiesApi;
use VFramework\Api\Client;

class Countries
{
    public function callApi(): void
    {
        $citiesApi = new CitiesApi(new Client('https://restcountries.eu/rest/v2/'));
        $citiesApi->getCountries();
    }
}

<?php


namespace VFramework\Controllers;

use VFramework\Api\Client;
use VFramework\Api\CountriesApi;
use VFramework\Helpers\UrlHelper;
use VFramework\Models\AbstractModel;
use VFramework\Models\Country;

class Countries
{
    public function __construct()
    {
        $this->model = new Country();
    }

    /**
     * @var array
     */
    protected $limitedCountries = [];


    public function countriesApi(): void
    {
        $citiesApi = new CountriesApi(new Client('https://restcountries.eu/rest/v2'));
        $countries = $citiesApi->getCountries();
        $countries = $this->makeCountriesArray($countries);
        foreach ($countries as $country)
        {
            $this->model->add($country);
        }
        die('Fecthed successfuly!');

    }

    /**
     * @param array $countries
     * @return array
     */
    public function makeCountriesArray(array $countries): array
    {
        foreach($countries as $country) {
            $countriesArray[] = [
            'name' => $country['name'],
            'alpha2Code' => $country['alpha2Code'],
            'capital' => $country['capital'],
            'region' => $country['region'],
            'subregion' => $country['subregion'],
            'population' => $country['population'],
            'latlng' => $country['latlng'][0],
            'area' => $country['area'],
            'timezones' => $country['timezones'][0]
            ];
        }
        return $countriesArray;
    }
}

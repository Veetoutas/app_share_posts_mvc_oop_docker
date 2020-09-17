<?php


namespace VFramework\Controllers;

use VFramework\Api\Client;
use VFramework\Api\CountriesApi;
use VFramework\Api\CountriesResponder;
use VFramework\Helpers\UrlHelper;
use VFramework\Models\AbstractModel;
use VFramework\Models\Country;

class Countries
{

    private const COUNTRIES_API = 'https://restcountries.eu/rest/v2';

    public function __construct()
    {
        $this->country = new Country();
    }

    /**
     * @return bool
     */
    public function countriesApi(): bool
    {
        $citiesApi = new CountriesApi(new Client(self::COUNTRIES_API));
        $countries = $citiesApi->getCountries();
        $countries = $this->makeCountriesArray($countries->toArray());

        foreach ($countries as $country)
        {
            $this->country->add($country);
        }

        return true;
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

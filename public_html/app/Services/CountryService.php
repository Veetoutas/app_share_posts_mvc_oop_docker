<?php

namespace VFramework\Services;

use VFramework\Api\Client;
use VFramework\Api\CountriesApi;
use VFramework\Collections\CountriesCollection;
use VFramework\DTO\CountryDTO;
use VFramework\Models\Country;

class CountryService
{
    private const COUNTRIES_API = 'https://restcountries.eu/rest/v2';

    /**
     * Saves Countries to the DB
     */
    public function getCountries(): void
    {
        $countriesApi = new CountriesApi(new Client(self::COUNTRIES_API));
        $countries = $countriesApi->getCountries();
        $countries = $this->buildCountriesCollection($countries->toArray());
        $this->saveToDatabase($countries);
    }

    /**
     * @param array $countries
     * @return CountriesCollection
     */
    public function buildCountriesCollection(array $countries): CountriesCollection
    {
        $countriesCollection = new CountriesCollection();

        foreach($countries as $country) {
            $latlng = implode(', ', $country['latlng']);
            $countriesCollection->add(new CountryDTO(
                $country['name'],
                $country['alpha2Code'],
                $country['capital'],
                $country['region'],
                $country['subregion'],
                $country['population'],
                $latlng,
                ($country['area'] ?: 0.0),
                $country['timezones'][0]
            ));
        }

        return $countriesCollection;
    }

    /**
     * @param CountriesCollection $countries
     */
    private function saveToDatabase(CountriesCollection $countries)
    {
        foreach ($countries->getAll() as $country) {
            $countryModel = new Country();
            $countryModel->add($country->toArray());
        }

        return true;
    }
}

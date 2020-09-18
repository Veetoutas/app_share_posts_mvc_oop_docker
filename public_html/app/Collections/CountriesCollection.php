<?php

namespace VFramework\Collections;

use VFramework\DTO\CountryDTO;

interface CollectionInterface
{
    public function add(CountryDTO $country);
    public function getAll();
}

class CountriesCollection implements CollectionInterface
{

    /**
     * @var CountryDTO[]
     */
    private $countries;

    /**
     * @param CountryDTO $country
     */
    public function add(CountryDTO $country)
    {
        $this->countries[] = $country;
    }

    /**
     * @return CountryDTO[]
     */
    public function getAll()
    {
        return $this->countries;
    }

    /**
     * @param $index
     * @return CountryDTO
     */
    public function getByIndex($index): CountryDTO
    {
        return $this->countries[$index];
    }
}

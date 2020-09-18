<?php

namespace VFramework\Controllers;

use VFramework\Models\Country;
use VFramework\Services\CountryService;

class Countries
{
    public function __construct()
    {
        $this->country = new Country();
        $this->service = new CountryService();
    }

    public function getCountries()
    {
        return $this->service->getCountries();
    }
}

<?php


namespace VFramework\Api;


class CountriesApi
{
    const ENDPOINT_ALL = '/all';

    /**
     * @var Client
     */
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getCountries()
    {
         return $response = $this->client->getRequest(self::ENDPOINT_ALL);
    }
}

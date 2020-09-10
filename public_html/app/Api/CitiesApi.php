<?php


namespace VFramework\Api;


use Client;

class CitiesApi
{
    const ENDPOINT_ALL = '/all';
    const ENDPOINT_SOMETHING = '/something'
    /**
     * @var Client
     */
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getCountries()
    {
        $response = $this->client->get(self::ENDPOINT_ALL);

    }

    public function getSomething()
    {
        $response = $this->client->get(self::ENDPOINT_SOMETHING); // thats all
    }

}

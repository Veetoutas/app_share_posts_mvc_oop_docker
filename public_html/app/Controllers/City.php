<?php


namespace VFramework\Controllers;


use VFramework\Api\Client;

class City
{
    public function callApi()
    {
        $client = new Client();
        $client->fetchApi();
    }
}


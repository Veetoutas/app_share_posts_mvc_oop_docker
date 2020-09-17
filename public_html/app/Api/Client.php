<?php

namespace VFramework\Api;

class Client
{

    /**
     * Client constructor.
     * @param string $api
     */
    public function __construct(string $api)
    {
        $this->api = $api;
    }

    /**
     * @param string $endPoint
     * @return mixed
     */
    public function postRequest(string $endPoint)
    {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $this->api . $endPoint);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle,CURLOPT_FAILONERROR,true);
        $response = curl_exec($curlHandle);
        curl_close ($curlHandle);

        return new CountriesResponder($response);
    }

    /**
     * @param string $endPoint
     * @return CountriesResponder
     */
    public function getRequest(string $endPoint): CountriesResponder
    {
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $this->api . $endPoint);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_FAILONERROR, true);
        $response = curl_exec($curlHandle);
        curl_close($curlHandle);

        return new CountriesResponder($response);
    }
}

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
        $response = json_decode($response, true);
        curl_close ($curlHandle);

        return $response;
    }

    /**
     * @param string $endPoint
     * @return mixed
     */
    public function getRequest(string $endPoint)
    {
        $responder = new Responder();
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL,$this->api . $endPoint);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle,CURLOPT_FAILONERROR,true);
        $response = curl_exec($curlHandle);
        // Catch errors and throw them or return true if no errors
        $responder->countriesResponder($curlHandle);
        $response = json_decode($response, true);
        curl_close ($curlHandle);

        return $response;
    }
}

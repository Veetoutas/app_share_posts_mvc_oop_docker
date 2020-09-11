<?php

namespace VFramework\Api;

class Client
{
    /**
     * Client constructor.
     * @param $api
     */
    public function __construct($api)
    {
        $this->api = $api;
    }

    /**
     * @param $endPoint
     * @return bool|string
     */
    public function postRequest($endPoint)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api . $endPoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getPostData());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        $response = json_decode($server_output, true);
        curl_close ($ch);
        return $server_output;
    }

    /**
     * @param $endPoint
     * @return mixed
     */
    public function getRequest($endPoint)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->api . $endPoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        $response = json_decode($server_output, true);
        curl_close ($ch);
        return $response;
    }

    public function getPostData()
    {
        return [
            'data' => 'postData',
        ];
    }
}

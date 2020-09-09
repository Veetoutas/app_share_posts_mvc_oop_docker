<?php


namespace VFramework\Api;


class Client
{

    public function fetchApi() {
        $ch = curl_init('https://restcountries.eu/rest/v2/all');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);

        foreach ($response as $country) {
            echo $country->name;
            echo '<br>';
        }
    }
}
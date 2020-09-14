<?php


namespace VFramework\Api;


use Exception;

class Responder
{
    /**
     * @param $curlHandle
     * @return bool
     * @throws Exception
     */
    public function countriesResponder($curlHandle): bool
    {
        if(curl_errno($curlHandle)){
            throw new Exception('Failed fecthing Countries, because: ' . curl_error($curlHandle));
        }

        return true;
    }
}

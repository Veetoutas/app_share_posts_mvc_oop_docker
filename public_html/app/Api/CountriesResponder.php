<?php

namespace VFramework\Api;

class CountriesResponder
{
    const ERROR_STATUS_CODES = [404, 400];

    /**
     * @var
     */
    private $response;

    /**
     * CountriesResponder constructor.
     * @param $response
     */
    public function __construct($response)
    {
        $this->isValid();
        $this->response = $response;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return json_decode($this->response, true);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        if (!in_array($this->response['status'], self::ERROR_STATUS_CODES)) {
            return true;
        }

        return false;
    }
}

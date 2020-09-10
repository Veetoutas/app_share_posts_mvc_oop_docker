<?php


class Client
{
    public function __construct($api)
    {
        $this->api = $api;
    }
    public function postRequest($patikslinimas)
    {
        // tai as ji isidesiu paskui sitam faile taip?y
        $postData = $this->getPostData();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api . $patikslinimas);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getPostData());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
    }
    // tai vsio, dabar reikia kitam faile nusirodyt patikslinimus ir issikviest

    public function getRequest($patikslinimas)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->api .$patikslinimas);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close ($ch);
    }

    public function getPostData()
    {
        return [
            'name' => 'Mantas',
        ];
    }
}
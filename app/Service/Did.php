<?php

namespace App\Service;

class Did
{
    protected $payload;

    public function __construct(array $payload_plain)
    {
        $this->payload = $payload_plain;
    }

    public function createDID()
    {
        $ch = curl_init();
        $payload = json_encode($this->payload , JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

        curl_setopt($ch, CURLOPT_URL, "https://nftidentityservice.iamx.id/did/plain");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);
        var_dump($result); exit;
        $jsonres =  json_decode($result, true);
        return $jsonres;
    }
}

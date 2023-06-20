<?php

namespace Mtech\Api;

use GuzzleHttp\Client;

class MtechApi
{


    const BASE_DOMAIN = "mtechcomm.co.ke";
    const BASE_SANDBOX_DOMAIN = "sandbox." . self::BASE_DOMAIN;

    protected $username;
    protected $apiKey;

    protected $client;
    protected $contentClient;
    protected $voiceClient;
    protected $tokenClient;
    public $baseUrl;

    public function __construct($username, $apiKey)
    {
        $this->baseUrl = "https://api." . self::BASE_SANDBOX_DOMAIN . "/index.php";
        $this->username = $username;
        $this->apiKey = $apiKey;


        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);


        $this->tokenClient = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);

    }

    public function token()
    {
        $content = new Content($this->tokenClient, $this->username, $this->apiKey);
        return new Token($this->tokenClient, $this->username, $this->apiKey, $content);
    }

    public function sms()
    {
        $content = new Content($this->client, $this->username, $this->apiKey);
        return new Sms($this->client, $this->username, $this->apiKey, $content);
    }

}
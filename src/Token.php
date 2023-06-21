<?php

namespace KabataMtech\Api;

use GuzzleHttp\Exception\RequestException;

class Token extends Service
{
    public function __construct($client, $username, $apiKey)
    {
        parent::__construct($client, $username, $apiKey);
    }

    public function token()
    {
        $data = [
            "username" => $this->username,
            "password" => $this->apiKey
        ];
        $response = $this->client->post("auth/token", ['json' => $data]);
        try {
            return $this->success($response);
        } catch (RequestException $e) {
            return $this->exception($e);
        }
    }
}
<?php

namespace KabataMtech\Api;

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
        $response = $this->client->post("auth/token", ['body' => $data]);
        return $this->success($response);
    }
}
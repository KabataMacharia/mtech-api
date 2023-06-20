<?php

namespace KabataMtech\Api;

class Token extends Service
{
    protected $content;

    public function __construct($client, $username, $apiKey, $content)
    {
        parent::__construct($client, $username, $apiKey);
        $this->content = $content;
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
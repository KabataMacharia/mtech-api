<?php

namespace KabataMtech\Api;

class Sms extends Service
{
    protected $content;

    public function __construct($client, $username, $apiKey, $content)
    {
        parent::__construct($client, $username, $apiKey);
        $this->content = $content;
    }

    public function send($options)
    {
        if (empty($options['msisdns']) || empty($options['message']) || empty($options['message_id'])) {
            return $this->error('At least one recipient must be defined');
        }

        if (empty($options['message'])) {
            return $this->error('Message must be defined');
        }

        if (empty($options['message_id'])) {
            return $this->error('Missing message id');
        }

        if (!is_array($options['msisdns'])) {
            $options['msisdns'] = [implode(",", $options['msisdns'])];
        }

        $data = [
            'message_id' => $options['message_id'],
            'username' => $this->username,
            'msisdns' => $options['msisdns'],
            'sender' => $options['sender'],
            'message' => $options['message']
        ];

        if (array_key_exists('encryption_method', $options) && $options['encryption_method']) {
            $data['encryption_method'] = 1;
        }

        if (array_key_exists('encrypted', $options) && $options['encrypted']) {
            $data['encrypted'] = 1;
        }

        $response = $this->client->post('messaging', ['form_params' => $data]);

        return $this->success($response);
    }
}
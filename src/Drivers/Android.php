<?php

namespace Tawba\PushNotification\Drivers;

use Tawba\PushNotification\Services\HttpClient;

class Android extends Sender
{
    /**
     * The default API base URL For Send push notification webservice
     * @var string
     */
    private $base_url = "https://android.googleapis.com/gcm/send";

    /**
     * The headers config
     * @var array $headers
     */
    private $headers = [
        'Authorization: key=' . "YOUR_API_KEY",
        'Content-Type: application/json',
    ];
    
    /**
     * The base Send push notification method
     *
     * @param $to
     * @param $message
     *
     * @return mixed
     */
    public function send($to, $message)
    {
        $fields = [
            'registration_ids' => $to,
            'data'             => $message,
        ];

        $client = new HttpClient($this->base_url, "POST", $fields, $this->headers);
        $result = $client->run();

        return $result;
    }
}



<?php

namespace Tawba\PushNotification\Drivers;

use Tawba\PushNotification\Services\HttpClient;

class Chrome extends Sender
{
    /**
     * The API base URL for google chrome api
     * @var string
     */
    private $baseUrl = 'https://android.googleapis.com/gcm/send';
    
    /**
     * The headers config
     * @var array $headers
     */
    private $headers = [
        'Authorization: key=' . "YOUR_API_KEY",
        'Content-Type: application/json',
    ];
    
    /**
     * The base send push notification method
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
    
        $client = new HttpClient($this->baseUrl, "POST", $fields, $this->headers);
        $result = $client->run();
    
        return $result;
    }
    
}

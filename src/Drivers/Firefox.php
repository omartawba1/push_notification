<?php

namespace Tawba\PushNotification\Drivers;

use Tawba\PushNotification\Services\HttpClient;

class Firefox extends Sender
{
    /**
     * The API base URL for firefox
     * @var string
     */
    private $baseUrl = 'https://updates.push.services.mozilla.com/push/' . "YOUR_SUBSCRIPTION_ID";
    
    /**
     * The headers config
     * @var array $headers
     */
    private $headers = [
        "userPublicKey: " . "YOUR_API_PUBLIC_KEY",
        "userAuthToken: " . "YOUR_API_AUTH_KEY",
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
        $client = new HttpClient($this->baseUrl, "POST", $message, $this->headers);
        $result = $client->run();
        
        return $result;
    }
    
}

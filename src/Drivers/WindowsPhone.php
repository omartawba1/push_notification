<?php

namespace Tawba\PushNotification\Drivers;

use Tawba\PushNotification\Services\HttpClient;

class WindowsPhone extends Sender
{
    /**
     * The default API base URL For Send push notification webservice
     * @var string
     */
    private $base_url = "http://s.notify.live.net/u/1/sin/";
    
    /**
     * The default channel name
     * @var string
     */
    private $channel_name = "Your_CHANNEL_NAME";
    
    /**
     * The headers config
     * @var array $headers
     */
    private $headers = [
        'Content-Type: text/xml',
        'Accept: application/*',
        'X-WindowsPhone-Target: toast',
        "X-NotificationClass: 2",
    ];
    
    /**
     * The base Send method
     *
     * @param $to
     * @param $message
     *
     * @return mixed
     */
    public function send($to, $message)
    {
        $fields = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<wp:Notification xmlns:wp=\"WPNotification\">" .
            "<wp:Toast>" .
            "<wp:Text1>" . htmlspecialchars($message['mTitle']) . "</wp:Text1>" .
            "<wp:Text2>" . htmlspecialchars($message['mDesc']) . "</wp:Text2>" .
            "</wp:Toast>" .
            "</wp:Notification>";
        
        $result = [];
        foreach ($to as $single_device) {
            $client   = new HttpClient($this->base_url . $single_device, "POST", $fields, $this->headers);
            $response = $client->run();
            foreach (explode("\n", $response) as $line) {
                $tab = explode(":", $line, 2);
                if (count($tab) == 2) {
                    $result[$tab[0]] = trim($tab[1]);
                }
            }
        }
        
        return $result;
    }
}



<?php

namespace Tawba\PushNotification\Drivers;

use Tawba\PushNotification\Services\HttpClient;

class IOS extends Sender
{
    /**
     * The default API base URL For Send push notification webservice
     * @var string
     */
    private $base_url = "ssl://gateway.sandbox.push.apple.com:2195";

    /**
     * The $passPhrase config
     * @var array $headers
     */
    private $passPhrase = 'YOUR_APPLE_PASS_PHRASE';

    /**
     * The $passPhrase config
     * @var array $headers
     */
    private $permissionFile = 'YOUR_PATH_TO_PEM_FILE';

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
        $deviceToken = $to;
        $ctx         = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', $this->permissionFile);
        stream_context_set_option($ctx, 'ssl', 'passphrase', $this->passPhrase);
        $fp = stream_socket_client($this->base_url, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp) {
            exit("Failed to connect: $err $errstr" . PHP_EOL);
        }
        
        $body['aps'] = [
            'alert' => [
                'title' => $message['mTitle'],
                'body'  => $message['mDesc'],
            ],
            'sound' => 'default',
        ];
        
        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        $result = fwrite($fp, $msg, strlen($msg));
        fclose($fp);

        return $result;
    }
}

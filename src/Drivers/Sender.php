<?php

namespace Tawba\PushNotification\Drivers;

abstract class Sender
{
    /**
     * The API base URL webservice
     * @var string
     */
    private $base_url;
    
    /**
     * Constructor for setting API base_url.
     *
     * @param $config
     */
    public function __construct($config = [])
    {
        $this->base_url = array_get($config, 'base_url', $this->base_url);
    }
    
    /**
     * The convert method
     *
     * @param $to
     * @param $message
     *
     * @return mixed
     */
    abstract public function send($to, $message);
}

<?php

namespace Tawba\PushNotification\Services;

class HttpClient
{
    /**
     * The API URL
     * @var string $url
     */
    private $url;
    
    /**
     * The API Request Headers
     * @var array $headers
     */
    private $headers;
    
    /**
     * The API method calling
     * @var string $method
     */
    private $method;
    
    /**
     * The API sent fields
     * @var string $fields
     */
    private $fields;
    
    /**
     * HttpClient constructor to set the API URL & Headers.
     *
     * @param string $url
     * @param string $method
     * @param array  $fields
     * @param array  $headers
     */
    public function __construct($url, $method = 'GET', $fields = [], $headers = [])
    {
        $this->url     = $url;
        $this->method  = $method;
        $this->fields  = $fields;
        $this->headers = $headers;
    }
    
    /**
     * Executing the API Call
     *
     * @return array
     */
    public function run()
    {
        $ch  = curl_init();
        $url = $this->url;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->method);
        if ($this->method === "POST") {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->fields));
        }
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
    
}

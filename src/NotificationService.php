<?php

namespace Tawba\PushNotification;

class NotificationService
{
    /**
     * The driver object "Android, IPhone, Chrome, Firefox ...etc"
     * @var object
     */
    private $driver;

    /**
     * @param $driver
     *
     * @return mixed
     */
    private function makeDriver($driver)
    {
        return SenderManager::makeByName($driver);
    }
    
    /**
     * The base send method
     *
     * @param string $driver
     * @param array  $to
     * @param array  $message
     *
     * @return mixed
     */
    public function send($driver, $to = [], $message = [])
    {
        $this->driver = $this->makeDriver($driver);

        return $this->driver->send($to, $message);
    }
}

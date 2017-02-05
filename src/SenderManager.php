<?php

namespace Tawba\PushNotification;

use Tawba\PushNotification\Drivers\Android;
use Tawba\PushNotification\Drivers\IOS;
use Tawba\PushNotification\Drivers\Chrome;
use Tawba\PushNotification\Drivers\Firefox;
use Tawba\PushNotification\Drivers\WindowsPhone;
use Tawba\PushNotification\Exceptions\DriverNotFoundException;

class SenderManager
{
    /**
     * The drivers array
     */
    public static $drivers = [
        'android'      => Android::class,
        'ios'          => IOS::class,
        'chrome'       => Chrome::class,
        'firefox'      => Firefox::class,
        'windowsphone' => WindowsPhone::class,
    ];
    
    /**
     * Registering the converter driver
     *
     * @param $name
     * @param $driverClass
     */
    public static function registerDriver($name, $driverClass)
    {
        if (!array_key_exists($name, self::$drivers)) {
            self::$drivers[$name] = $driverClass;
        }
    }
    
    /**
     * Find Driver By Name
     *
     * @param $name
     *
     * @return mixed
     */
    public static function findByName($name)
    {
        if (!array_key_exists($name, self::$drivers)) {
            throw new DriverNotFoundException("Driver [$name] not known!");
        }
        
        return self::$drivers[$name];
    }
    
    /**
     * Building the converter instance
     *
     * @param $driverClass
     * @param $config
     *
     * @return object
     */
    private static function buildConverter($driverClass, $config)
    {
        $reflectionClass = new \ReflectionClass($driverClass);
        
        return $reflectionClass->newInstanceArgs([$config]);
    }
    
    /**
     * Build the driver
     *
     * @param       $name
     * @param array $config
     *
     * @return object
     */
    public static function makeByName($name, $config = [])
    {
        $driverClass = self::findByName($name);
        
        return self::buildConverter($driverClass, $config);
    }
}

<?php

// Composer autoload
require_once __DIR__ . '/vendor/autoload.php';

use Tawba\PushNotification\NotificationService;

$notify = new NotificationService();

echo "<pre>";
print_r($notify->send("android", ['testID', ['Test MSG']])); // You can pass android, ios, windowsphone, chrome, firefox

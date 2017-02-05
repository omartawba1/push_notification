## Description

Push notification package helps you to easily push messages to Android, IOS, WindowsPhone, Chrome, and Firefox devices.


## Installation
Using Composer :

```
composer install
```

Or you can do

```
composer require tawba/push-notification
```

If you don't have composer, you can get it from [Composer](https://getcomposer.org/)


## Run the application

```
php index.php
```

## Usage

```
use Tawba\PushNotification\NotificationService;

$notify = new NotificationService();
echo "<pre>";
print_r($notify->send("android", ['testID', ['Test MSG']])); // You can pass android, ios, windowsphone, chrome, firefox

```

## Important Notice

You should change your authentication data inside each driver if you want to use it.
These are the drivers Android::class, IOS::class, WindowsPhone::class, Chrome::class, and Firefox::class

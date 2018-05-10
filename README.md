# App4Less push notifications channel

This package makes it easy to send app4less notifications and app4less Utils.

## Installation

You can install the package via composer:

``` bash
composer require webimpacto/app4less
```

## Usage

### Send Notifications

Initialice App4less Client

``` php
    $client = new \Webimpacto\App4Less\Client('app_user','app_apikey');
```

Send notifications:

``` php
    $client->sendPushNotification(
                    'token',
                    'title'
                    'url',
                    'utm'
                );
```

### Check isApp4Less
``` php
    $client = new \Webimpacto\App4Less\Client('app_user','app_apikey');
```

### Get Token App
``` php
    $token = \Webimpacto\App4Less\Client::getAppUUID();
```

### Get UUID App
``` php
    $uuid = \Webimpacto\App4Less\Client::getAppUUID();
```



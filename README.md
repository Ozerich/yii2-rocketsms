# yii2-rocketsms
Yii2 component for SMS provider RocketSMS.by

Installation
------------

1. The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

	Either run
	
	```
	php composer.phar require ozerich/yii2-rocketsms "*"
	```
	
	or add
	
	```
	"ozerich/yii2-rocketsms": "*"
	```
	
	to the require section of your `composer.json` file.

2. Add component configuration to your config.php

```php
    'components' => [
        'sms' => [
            'class' => 'blakit\rocketsms\RocketSms',
            'login' => 'your_login',
            'password' => 'your_password'
        ]
    ]
```

Usage
-----

Send SMS:

```php
try {
    $response = \Yii::$app->sms->send('+375296000000', 'Test Message');
    echo 'SMS sent, message ID is ' . $response->getMessageId();
} catch (ErrorResponseException $exception) {
    echo 'Error sending SMS: ' . $exception->getError();
} catch (InvalidCredentialsException $exception) {
    echo 'RocketSMS credentials are invalid';
}
```

Check Balance:

```php
try {
    $response = \Yii::$app->sms->balance();
    echo 'Your balance: ' . $response->getBalance() . 'BYN, ' . $response->getCredits() . ' SMS';
} catch (InvalidCredentialsException $exception) {
    echo 'RocketSMS credentials are invalid';
}
```

Get message status:

```php
try {
    $response = \Yii::$app->sms->status('MESSAGE_ID');
    echo 'Message status: ' . $response->getStatus();
} catch (ErrorResponseException $exception) {
    echo 'Message not found';
} catch (InvalidCredentialsException $exception) {
    echo 'RocketSMS credentials are invalid';
}
```

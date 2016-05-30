Laravel Google Authenticator
===========
This is a framework agnostic PHP library for using Google Authenticator service for one time password generation. This library can also be used as a service provider for Laravel 5 applications.

What is Google Authenticator?
===
According to [*Wikipedia*](https://en.wikipedia.org/wiki/Google_Authenticator)

> Google Authenticator is an application that implements TOTP or HOTP security tokens from RFC 6238 in mobile apps made by Google, sometimes branded "two-step verification". Authenticator provides a six- to eight-digit one-time password which users must provide in addition to their username and password to log in to Google services or other sites. The Authenticator can also generate codes for third-party applications, such as password managers or file hosting services.

It is a service which generates a one time password to be used on third party application, which can be used along with Google Authenticator App to make a nifty two step verification.

Basically, these steps are followed

* A secret key is generated
* Using that secret key and other optional parameters, a one time password and a QR code is generated
* User has to scan the QR code with the Google Authenticator App to get the one time password
* User inputs the one time password
* The password is validated

Install
===
Use the following command to install the library using ``composer``

```
composer require faheem00/laravel-google-authenticator
```

Run as a PHP package
===

First, instantiate the Google Authenticator class:

```php
<?php
use Faheem00\LaravelGoogleAuthenticator\GoogleAuthenticator;

$google_authenticator = new GoogleAuthenticator();
```

Then you can use the class in the following way:

```php
//Get a otp instance, label and issuer are optional
$otp_instance = $google_authenticator->getInstance('label','issuer');
//Get Google QR Code URL
//You can display the QR Code by setting the url to src of an image
$qrCodeUrl = $google_authenticator->getQRCodeGoogleUrl($otp_instance);
//You can also get the QR Code url without using the $otp_instance, as the instance is set on the class when instantiated
// $qrCodeUrl = $google_authenticator->getQRCodeGoogleUrl();
//Get one time code input from user, or manually using the library, in $oneCode variable
$one_time_code = $google_authenticator->getCode($otp_instance);
//Again, we can do without otp instance to get one time code for current instance
// $one_time_code = $google_authenticator->getCode();
//Verify the one time code
$checkResult = $google_authenticator->verifyCode($one_time_code, $otp_instance);
//Using without the $otp_instance
// $checkResult = $google_authenticator->verifyCode($one_time_code, $otp_instance);
//$checkResult is a boolean, will return true on accurate code, false otherwise
if($checkResult) echo 'Verified!';
else echo 'Not Verified';
```

Run using Laravel 5
======
First, add the following line to the ``providers`` array on ``config/app.php``

```php
Faheem00\LaravelGoogleAuthenticator\Providers\GoogleAuthenticatorServiceProvider::class
```

If you want to use Facade, you can add the following line to `aliases` array on ``config/app.php``

```php
'Googleauthenticator' => Faheem00\LaravelGoogleAuthenticator\Facades\GoogleAuthenticator::class
```

Using the class
---
You can use the ``Googleauthenticator`` Facade to use the class

```php
//Get a otp instance, label and issuer are optional
$otp_instance = Googleauthenticator::getInstance('label','issuer');
//Get Google QR Code URL
//You can display the QR Code by setting the url to src of an image
$qrCodeUrl = Googleauthenticator::getQRCodeGoogleUrl($otp_instance);
//You can also get the QR Code url without using the $otp_instance, as the instance is set on the class when instantiated
// $qrCodeUrl = Googleauthenticator::getQRCodeGoogleUrl();
//Get one time code input from user, or manually using the library, in $oneCode variable
$one_time_code = Googleauthenticator::getCode($otp_instance);
//Again, we can do without otp instance to get one time code for current instance
// $one_time_code = Googleauthenticator::getCode();
//Verify the one time code
$checkResult = Googleauthenticator::verifyCode($one_time_code, $otp_instance);
//Using without the $otp_instance
// $checkResult = Googleauthenticator::verifyCode($one_time_code, $otp_instance);
//$checkResult is a boolean, will return true on accurate code, false otherwise
if($checkResult) echo 'Verified!';
else echo 'Not Verified';
```

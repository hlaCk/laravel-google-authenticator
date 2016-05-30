<?php

use Faheem00\LaravelGoogleAuthenticator\GoogleAuthenticator;

class BaseTest extends PHPUnit_Framework_TestCase
{

    private $google_authenticator;

    public function setUp()
    {
        $this->google_authenticator = new GoogleAuthenticator();
    }

    public function testCanBeInstantiated()
    {
        $this->assertInstanceOf(GoogleAuthenticator::class, new GoogleAuthenticator());
    }

    public function testIsInstanceOfTOTP()
    {
        $instance = $this->google_authenticator->getInstance('testlabel@test.com', 'testIssuer');
        $this->assertInstanceOf(OTPHP\TOTP::class, $instance);
        return $instance;
    }

    /**
     * @depends testIsInstanceOfTOTP
     */
    public function testQrCodeWithInstance(OTPHP\TOTP $instance)
    {
        $qr_code = $this->google_authenticator->getQRCodeGoogleUrl($instance);

        $url_parts = parse_url($qr_code);
        $this->assertEquals($url_parts['scheme'], 'https');
        $this->assertEquals($url_parts['host'], 'chart.googleapis.com');
        $this->assertEquals($url_parts['path'], '/chart');

        $this->assertContains(urlencode($instance->getSecret()), urldecode($qr_code));
        $this->assertContains(urlencode($instance->getLabel()), urldecode($qr_code));
        $this->assertContains(urlencode($instance->getIssuer()), urldecode($qr_code));
    }

    public function testQrCodeWithoutInstance()
    {
        $instance = $this->google_authenticator->getInstance('testlabel@test.com', 'testIssuer');
        $qr_code = $this->google_authenticator->getQRCodeGoogleUrl();

        $url_parts = parse_url($qr_code);
        $this->assertEquals($url_parts['scheme'], 'https');
        $this->assertEquals($url_parts['host'], 'chart.googleapis.com');
        $this->assertEquals($url_parts['path'], '/chart');

        $this->assertContains(urlencode($instance->getSecret()), urldecode($qr_code));
        $this->assertContains(urlencode($instance->getLabel()), urldecode($qr_code));
        $this->assertContains(urlencode($instance->getIssuer()), urldecode($qr_code));
    }

    /**
     * @depends testIsInstanceOfTOTP
     */
    public function testCodeVerificationWithInstance(OTPHP\TOTP $instance)
    {
        $this->assertTrue($this->google_authenticator->verifyCode($this->google_authenticator->getCode($instance), $instance));
        $this->assertFalse($this->google_authenticator->verifyCode("INVALID", $instance));
    }

    public function testCodeVerificationWithoutInstance()
    {
        $instance = $this->google_authenticator->getInstance('testlabel@test.com', 'testIssuer');
        $this->assertTrue($this->google_authenticator->verifyCode($this->google_authenticator->getCode()));
        $this->assertFalse($this->google_authenticator->verifyCode("INVALID"));
    }
}

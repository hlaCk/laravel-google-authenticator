<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2016 Faheem Abrar
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Faheem00\LaravelGoogleAuthenticator;

use Base32\Base32;
use OTPHP\TOTP;

class GoogleAuthenticator
{
    /**
     * The otp instance
     * @var OTPHP\TOTP
     */
    private $totp;

    /**
     * Create a 64 bit secret string
     * @return string
     */
    private function createSecret()
    {
        return Base32::encode(random_bytes(64));
    }

    /**
     * Get an otp instance
     * @param string $label A custom label to use
     * @param null $issuer A custom issuer to use
     * @return OTPHP\TOTP
     */
    public function getInstance($label = 'faheem00', $issuer = null)
    {
        $this->totp = new TOTP(
            $label,
            $this->createSecret()
        );
        if ($issuer) $this->totp->setIssuer($issuer);
        return $this->totp;
    }

    /**
     * Get the QR Code URL for the otp instance
     * @param TOTP|null $totp
     * @return string
     */
    public function getQRCodeGoogleUrl(TOTP $totp = null)
    {
        $base_url = 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=';
        if ($totp !== null) return $base_url . urlencode($totp->getProvisioningUri());
        else return $base_url . urlencode($this->totp->getProvisioningUri());
    }

    /**
     * Get the one time code for the otp instance
     * @param TOTP|null $totp
     * @return mixed
     */
    public function getCode(TOTP $totp = null)
    {
        if ($totp !== null) return $totp->now();
        else return $this->totp->now();
    }

    /**
     * Verify one time code using the otp instance
     * @param $one_time_code
     * @param TOTP|null $totp
     * @return bool
     */
    public function verifyCode($one_time_code, TOTP $totp = null)
    {
        if ($totp !== null) return $totp->verify($one_time_code);
        else return $this->totp->verify($one_time_code);
    }
}

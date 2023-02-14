<?php
/**
 * BIM Package for license key validation.
 *
 * @copyright Copyright (c) Kyrylo Kostiukov 2023 - All Rights Reserved
 * @license MIT
 * @project cmd-license-key
 */

namespace LicenseKey;

use LicenseKey\Module\Key;

class LicenseKey
{
    /**
     * @var string[]
     */
    private static $options = ['platform', 'expiry', 'modules'];

    /**
     * @param string $key
     * @param null|string $option Provide one of the options [platform|expiry|modules] for return string
     * @return array|string
     * @throws Exception\LicenseKeyMalformedException
     * @throws Exception\LicenseKeyVersionInvalidException
     */
    public function keyInfo($key, $option = null)
    {
        if ($key === '') {
            throw new \Exception("Provided empty license key. Please, specify license text.");
        }

        $key = new Key(null, $key);

        $keyData = $key->dumpKeyInfo();

        $platform = $keyData['data'][0];

        $modules = $keyData['data'][2];

        // Get last module from modules array for getting expiry date
        $lastModule = array_pop($modules);

        $expiryDate = date("d-m-Y", strtotime(array_pop($lastModule)));

        $data = [
            'platform' => $platform,
            'expiry' => $expiryDate,
            'modules' => $modules
        ];

        if ($option !== null) {
            if (!in_array($option, self::$options)) {
                throw new \Exception(sprintf("Option '%s' is not exists. Choose one of the available options [platform|expiry|modules].", $option));
            }

            return $data[$option];
        }

        return $data;
    }

    /**
     * @param string $key
     * @param string  $domain
     * @param string  $platform
     * @param string  $software
     * @param string  $software_version
     * @throws Exception\LicenseDomainException
     * @throws Exception\LicenseExpiredException
     * @throws Exception\LicenseKeyInvalidException
     * @throws Exception\LicenseKeyMalformedException
     * @throws Exception\LicenseKeyVersionInvalidException
     * @throws Exception\LicenseKeyWarningException
     * @throws Exception\MissingComponentException
     */
    public function verifyKey($key, $domain, $platform, $software, $software_version)
    {
        if ($key === '') {
            throw new \Exception("Provided empty license key. Please, specify license text.");
        }

        if ($domain === '') {
            throw new \Exception("Provided empty domain value. Please, specify domain.");
        }

        if ($platform === '') {
            throw new \Exception("Provided empty platform value. Please, specify platform.");
        }

        if ($software === '') {
            throw new \Exception("Provided empty software value. Please, specify software.");
        }

        if ($software_version === '') {
            throw new \Exception("Provided empty software version value. Please, specify software version.");
        }

        $key = new Key($software, $key);
        $key->validate($domain, $platform, $software_version);
    }
}
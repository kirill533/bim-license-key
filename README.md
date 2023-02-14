# BIM License Key

BIM License Key is a package that provide methods for validation or describe information about license.

## Installation

Paste the code below to composer.json and run composer update.

    "require": {
        "bim/license-key": "*"
    }

Or execute: 
    
    composer require bim/license-key

## Usage

The package has two methods for working with licenses:

### `keyInfo (string key, option = null)`

Describes information about license. First argument `key` contains license text.
Use second argument `option` to get certain pieces of license information (platform,expiry,modules).
Argument `option` has available option [platform,expiry,modules] by default null.

### `verifyKey (string key, string domain, string platform, string software, string software_version)`

Verification license. Argument `key` contains license text. `domain` should contains domain name 
of license. `platform` should contains one of the available platforms (m1,m2,pawbo). `software`
should contains software name which you want to verify. `software_version` contains software version
of the software.

## Examples

Here is an example of keyInfo method.

``` php
<?php

require_once 'vendor/autoload.php';

$licenseText = '===LICENCE TEXT===';

$licenseKey = new \LicenseKey\LicenseKey();
$data = $licenseKey->keyInfo($licenseText);
```
Array '$data' will contain array of license information.

``` php
array (
  'platform' => 'pawbo',
  'expiry' => '01-01-2024',
  'modules' => 
  array (
    0 => 
    array (
      0 => 'bim/pawbo',
      1 => '1.0.0',
      2 => 'term',
      3 => '20240101',
    )
  );
```

Here is an example of verifyKey method.

``` php
<?php

require_once 'vendor/autoload.php';

$licenseText = '===LICENCE TEXT===';
$domain = 'localhost';
$platform = 'pawbo';
$software = 'software/software';
$software_version = '1.0.0';

try {
    $data = $licenseKey->verifyKey($licenseText, $domain, $platform, $software, $software_version);   
} catch (\Exception $e) {
    //
}
```

Response of verifyKey:
``` 
 // Exception if license is not valid:
 Software software/software is not covered by the license.
```
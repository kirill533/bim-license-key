<?php
/**
 * BIM Package for license key validation.
 *
 * @copyright Copyright (c) Kyrylo Kostiukov 2023 - All Rights Reserved
 * @license MIT
 * @project cmd-license-key
 */

namespace LicenseKey\Exception;

class LicenseKeyMalformedException extends \Exception
{
    const CODE_WRONG_FORMAT = 424;
    const CODE_WRONG_MODULE = 426;
}
<?php
/**
 * BIM Package for license key validation.
 *
 * @copyright Copyright (c) Kyrylo Kostiukov 2023 - All Rights Reserved
 * @license MIT
 * @project cmd-license-key
 */

namespace LicenseKey\Exception;


class LicenseKeyWarningException extends \Exception
{
    const CODE_EXPIRED_AFTER_TWO_WEEKS = 571;
}
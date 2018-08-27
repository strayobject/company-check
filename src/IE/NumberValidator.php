<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\IE;

use Strayobject\CompanyCheck\UnhandledTypeException;
use Strayobject\CompanyCheck\CompanyValidatorInterface;

/**
 * Class NumberValidator
 * @package Strayobject\CompanyCheck\IE
 */
class NumberValidator implements CompanyValidatorInterface
{
    use SupportTrait;

    /**
     * @param string $number
     * @param string $countryCode
     * @return bool
     */
    public function isValidNumber(string $number, string $countryCode): bool
    {
        if (!$this->supports($countryCode)) {
            throw new UnhandledTypeException(\sprintf('No provider able to handle %s code', $countryCode));
        }

        return \is_numeric($number);
    }
}

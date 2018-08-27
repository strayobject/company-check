<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck;

/**
 * Interface CompanyValidatorInterface
 * @package Strayobject\CompanyCheck
 */
interface CompanyValidatorInterface
{
    /**
     * @param string $countryCode
     * @return bool
     */
    public function supports(string $countryCode): bool;
    /**
     * @return array
     */
    public function getSupported(): array;
    /**
     * @param string $number
     * @param string $countryCode
     * @return bool
     */
    public function isValidNumber(string $number, string $countryCode): bool;
}

<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck;

use ArrayIterator;

/**
 * Interface CompanyListProviderInterface
 * @package Strayobject\CompanyCheck
 */
interface CompanyListProviderInterface
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
     * @param string $name
     * @return ArrayIterator
     */
    public function getListByName(string $name): ArrayIterator;

    /**
     * @param string $number
     * @return ArrayIterator
     */
    public function getListByNumber(string $number): ArrayIterator;

    /**
     * @param string $query
     * @param string $countryCode
     * @return ArrayIterator
     */
    public function getList(string $query, string $countryCode): ArrayIterator;
}

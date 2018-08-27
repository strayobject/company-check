<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\IE;

/**
 * Trait SupportTrait
 * @package Strayobject\CompanyCheck\IE
 */
trait SupportTrait
{
    /**
     * @var array
     */
    private $supported = [
        'IE',
    ];

    /**
     * @param string $countryCode
     * @return bool
     */
    public function supports(string $countryCode): bool
    {
        return \in_array($countryCode, $this->getSupported());
    }

    /**
     * @return array
     */
    public function getSupported(): array
    {
        return $this->supported;
    }
}

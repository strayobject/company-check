<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\GB;

/**
 * Trait SupportTrait
 * @package Strayobject\CompanyCheck\GB
 */
trait SupportTrait
{
    /**
     * @var array
     */
    private $supported = [
        'GB',
        'GB-ENG',
        'GB-SCT',
        'GB-WLS',
        'GB-NIR',
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

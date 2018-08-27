<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck;

/**
 * Class CompanyListProvider
 * @package Strayobject\CompanyCheck
 */
class CompanyListProvider
{
    /**
     * @var CompanyListProviderInterface[]
     */
    private $providers;

    /**
     * @param string $countryCode
     * @return CompanyListProviderInterface
     */
    public function getProviderFor(string $countryCode): CompanyListProviderInterface
    {
        if (!isset($this->providers[$countryCode])) {
            throw new UnhandledTypeException(\sprintf('No provider able to handle %s code', $countryCode));
        }

        return $this->providers[$countryCode];
    }

    /**
     * @param CompanyListProviderInterface $provider
     * @return CompanyListProvider
     */
    public function addProvider(CompanyListProviderInterface $provider): CompanyListProvider
    {
        foreach ($provider->getSupported() as $countryCode) {
            $this->providers[$countryCode] = $provider;
        }

        return $this;
    }
}

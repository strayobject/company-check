<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck;

use JsonSerializable;

/**
 * Class CompanyAddress
 * @package Strayobject\CompanyCheck
 */
class CompanyAddress implements JsonSerializable
{
    /**
     * @var string
     */
    private $addressLine1;
    /**
     * @var string
     */
    private $addressLine2;
    /**
     * @var string
     */
    private $locality;
    /**
     * @var string
     */
    private $region;
    /**
     * @var string
     */
    private $postCode;

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return \get_object_vars($this);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return !\array_filter($this->jsonSerialize());
    }

    /**
     * Getter for AddressLine1
     *
     * @return string
     */
    public function getAddressLine1(): string
    {
        return (string) $this->addressLine1;
    }

    /**
     * Setter for AddressLine1
     *
     * @param string $addressLine1
     *
     * @return CompanyAddress
     */
    public function setAddressLine1(string $addressLine1): CompanyAddress
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    /**
     * Getter for AddressLine2
     *
     * @return string
     */
    public function getAddressLine2(): string
    {
        return (string) $this->addressLine2;
    }

    /**
     * Setter for AddressLine2
     *
     * @param string $addressLine2
     *
     * @return CompanyAddress
     */
    public function setAddressLine2(string $addressLine2): CompanyAddress
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * Getter for Locality
     *
     * @return string
     */
    public function getLocality(): string
    {
        return (string) $this->locality;
    }

    /**
     * Setter for Locality
     *
     * @param string $locality
     *
     * @return CompanyAddress
     */
    public function setLocality(string $locality): CompanyAddress
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * Getter for Region
     *
     * @return string
     */
    public function getRegion(): string
    {
        return (string) $this->region;
    }

    /**
     * Setter for Region
     *
     * @param string $region
     *
     * @return CompanyAddress
     */
    public function setRegion(string $region): CompanyAddress
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Getter for PostCode
     *
     * @return string
     */
    public function getPostCode(): string
    {
        return (string) $this->postCode;
    }

    /**
     * Setter for PostCode
     *
     * @param string $postCode
     *
     * @return CompanyAddress
     */
    public function setPostCode(string $postCode): CompanyAddress
    {
        $this->postCode = $postCode;

        return $this;
    }
}

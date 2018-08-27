<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck;

use stdClass;

/**
 * Interface CompanyDataInterface
 * @package Strayobject\CompanyCheck
 */
interface CompanyDataInterface
{
    /**
     * Getter for Id
     *
     * @return string
     */
    public function getId(): string;
    /**
     * Getter for Name
     *
     * @return string
     */
    public function getName(): string;
    /**
     * Getter for Number
     *
     * @return string
     */
    public function getNumber(): string;
    /**
     * Getter for Type
     *
     * @return string
     */
    public function getType(): string;
    /**
     * Getter for Address string
     *
     * @return string
     */
    public function getAddressString(): string;
    /**
     * Getter for Address
     *
     * @return CompanyAddress
     */
    public function getAddress(): CompanyAddress;

    /**
     * Getter for the response
     *
     * @return stdClass
     */
    public function getOriginalResponse(): stdClass;
}

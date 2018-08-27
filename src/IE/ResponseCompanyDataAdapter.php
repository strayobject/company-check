<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\IE;

use JsonSerializable;
use stdClass;
use Strayobject\CompanyCheck\CompanyAddress;
use Strayobject\CompanyCheck\CompanyDataInterface;

/**
 * Class ResponseCompanyDataAdapter
 * @package Strayobject\CompanyCheck\IE
 */
class ResponseCompanyDataAdapter implements CompanyDataInterface, JsonSerializable
{
    /**
     * @var stdClass
     */
    private $response;
    /**
     * @var CompanyAddress
     */
    private $address;

    /**
     * CompanyDataResultAdapter constructor.
     * @param stdClass $response
     */
    public function __construct(stdClass $response)
    {
        $this->response = $response;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'number' => $this->getNumber(),
            'address' => $this->getAddressString(),
            'type' => $this->getType(),
        ];
    }

    /**
     * Getter for Id
     *
     * @return string
     */
    public function getId(): string
    {
        return \sprintf('%s%s', $this->response->company_bus_ind, $this->response->company_num);
    }

    /**
     * Getter for Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->response->company_name;
    }

    /**
     * Getter for Number
     *
     * @return string
     */
    public function getNumber(): string
    {
        return (string) $this->response->company_num;
    }

    /**
     * Getter for Address
     *
     * @return string
     */
    public function getAddressString(): string
    {
        $address = $this->address ?? $this->getAddress();

        return \implode(', ', \array_filter(\array_values($address->jsonSerialize())));
    }

    /**
     * @return CompanyAddress
     */
    public function getAddress(): CompanyAddress
    {
        $this->address = (new CompanyAddressBuilder())->build($this->response);

        return $this->address;
    }

    /**
     * Getter for Type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->response->company_bus_ind;
    }

    /**
     * Getter for the response
     *
     * @return stdClass
     */
    public function getOriginalResponse(): stdClass
    {
        return $this->response;
    }
}

<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\GB;

use JsonSerializable;
use stdClass;
use Strayobject\CompanyCheck\CompanyAddress;
use Strayobject\CompanyCheck\CompanyDataInterface;

/**
 * Class ResponseMultiCompanyDataAdapter
 * @package Strayobject\CompanyCheck\GB
 */
class ResponseMultiCompanyDataAdapter implements CompanyDataInterface, JsonSerializable
{
    /**
     * @var stdClass
     */
    private $response;

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
        return (string) $this->response->company_number;
    }

    /**
     * Getter for Name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->response->title;
    }

    /**
     * Getter for Number
     *
     * @return string
     */
    public function getNumber(): string
    {
        return (string) $this->response->company_number;
    }

    /**
     * Getter for Address
     *
     * @return string
     */
    public function getAddressString(): string
    {
        return (string) $this->response->address_snippet;
    }

    /**
     * @return CompanyAddress
     */
    public function getAddress(): CompanyAddress
    {
        $responseAddress = $this->response->address ?? $this->response->registered_office_address;

        if (!(array) $responseAddress) {
            return new CompanyAddress();
        }

        $line1 = [
            isset($responseAddress->premises) ? \trim($responseAddress->premises): null,
            $responseAddress->address_line_1 ?? null
        ];
        $addressLine1 = \implode(', ', \array_filter($line1));

        return (new CompanyAddress())
            ->setAddressLine1($addressLine1)
            ->setAddressLine2($responseAddress->address_line_2 ?? '')
            ->setLocality($responseAddress->locality)
            ->setRegion($responseAddress->region ?? '')
            ->setPostCode($responseAddress->postal_code);
    }

    /**
     * Getter for Type
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->response->company_type;
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

<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\IE;

use stdClass;
use Strayobject\CompanyCheck\CompanyAddress;

/**
 * Class CompanyAddressBuilder
 * @package Strayobject\CompanyCheck\IE
 */
class CompanyAddressBuilder
{
    /**
     * @param stdClass $response
     * @return CompanyAddress
     */
    public function build(stdClass $response): CompanyAddress
    {
        $address = new CompanyAddress();

        if ($response->company_addr_4) {
            $address->setAddressLine1($this->formatString($response->company_addr_1));
            $address->setAddressLine2($this->formatString($response->company_addr_2));
            $address->setLocality($this->formatString($response->company_addr_3));
            $address->setRegion($this->formatString($response->company_addr_4));
        } elseif ($response->company_addr_3) {
            $address->setAddressLine1($this->formatString($response->company_addr_1));
            $address->setLocality($this->formatString($response->company_addr_2));
            $address->setRegion($this->formatString($response->company_addr_3));
        } elseif ($response->company_addr_2) {
            $address->setAddressLine1($this->formatString($response->company_addr_1));
            $address->setRegion($this->formatString($response->company_addr_2));
        } else {
            $address->setAddressLine1($this->formatString($response->company_addr_1));
        }

        if ($response->eircode) {
            $address->setPostCode($response->eircode);
        }

        return $address;
    }

    /**
     * @param string $string
     * @return string
     */
    private function formatString(string $string): string
    {
        $string = \rtrim($string, ',. ');

        return $string;
    }
}

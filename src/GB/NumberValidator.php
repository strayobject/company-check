<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\GB;

use Strayobject\CompanyCheck\UnhandledTypeException;
use Strayobject\CompanyCheck\CompanyValidatorInterface;

/**
 * @todo improve based on www.hmrc.gov.uk/gds/com/attachments/coy_reg_no_formats.doc
 * Class NumberValidator
 * @package Strayobject\CompanyCheck\GB
 */
class NumberValidator implements CompanyValidatorInterface
{
    use SupportTrait;

    /**
     * @param string $number
     * @param string $countryCode
     * @return bool
     */
    public function isValidNumber(string $number, string $countryCode): bool
    {
        if (!$this->supports($countryCode)) {
            throw new UnhandledTypeException(\sprintf('No provider able to handle %s code', $countryCode));
        }

        return $this->isValidEngland($number)
            || $this->isValidScotland($number)
            || $this->isValidNorthernIreland($number);
    }

    /**
     * Companies registered in England and Wales, which make up the majority of those on the company register,
     * have an 8 digit company registration number beginning with 0. The leading zero is omitted in some places.
     * A Limited Liability Partnership (LLP) registered in England and Wales will begin with 'OC' followed by 6 numbers.
     * A Limited Partnership registered in England and Wales will begin with 'LP' followed by 6 numbers.
     * A CIO registered in England and Wales begins with 'CE' followed by 6 digits.
     *
     * @param string $number
     * @return bool
     */
    public function isValidEngland(string $number): bool
    {
        $number = \strtolower($number);
        $letters = $number[0].$number[1];
        $ltd = (\strlen($number) === 8 && $number[0] === '0') || (\strlen($number) === 7 && \is_numeric($number));
        $other = \strlen($number) === 8 && ($letters === 'oc' || $letters === 'lp' || $letters === 'ce');

        return $ltd || $other;
    }

    /**
     * The company registration number for limited companies in Scotland begins with 'SC' followed by 6 digits.
     * The format for Scottish LLPs begins 'SO' followed by 6 digits.
     * The format for Scottish LPs begins 'SL' followed by 6 digits.
     * The format for Scottish charities begins with 'CS' followed by 6 digits
     *
     * @param string $number
     * @return bool
     */
    public function isValidScotland(string $number): bool
    {
        $number = \strtolower($number);
        $letters = $number[0].$number[1];

        return \strlen($number) === 8
            && ($letters === 'sc' || $letters === 'so' || $letters === 'sl' || $letters === 'cs');
    }

    /**
     * Limited companies based in Northern Ireland are identified by 'NI' followed by 6 digits.
     * There are also some older Northern Irish companies with company registration numbers beginning 'R'
     * followed by 7 digits, but no new numbers are issued on this basis.
     * LLPs registered in Northern Ireland have references beginning 'NC' followed by 6 numbers.
     * LPs registered in Northern Ireland have references beginning 'NL' followed by 6 numbers.
     *
     * @param string $number
     * @return bool
     */
    public function isValidNorthernIreland(string $number): bool
    {
        $number = \strtolower($number);
        $letters = $number[0].$number[1];
        $old = $number[0] === 'r' && \is_numeric(\substr($number, 1));

        return \strlen($number) === 8 && ($old || $letters === 'ni' || $letters === 'nc' || $letters === 'nl');
    }
}

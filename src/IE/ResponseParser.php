<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\IE;

use ArrayIterator;
use Strayobject\CompanyCheck\ResponseParserInterface;

/**
 * Class ResponseParser
 * @package Strayobject\CompanyCheck\IE
 */
class ResponseParser implements ResponseParserInterface
{
    /**
     * @param array $response
     * @return ArrayIterator
     */
    public function parse(array $response): ArrayIterator
    {
        $data = new ArrayIterator();

        foreach ($response as $item) {
            $data->append(new ResponseCompanyDataAdapter($item));
        }

        return $data;
    }
}

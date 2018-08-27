<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck;

use ArrayIterator;

/**
 * Interface ResponseParserInterface
 * @package Strayobject\CompanyCheck
 */
interface ResponseParserInterface
{
    /**
     * @param array $response
     * @return ArrayIterator
     */
    public function parse(array $response): ArrayIterator;
}

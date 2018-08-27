<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\GB;

use ArrayIterator;
use Strayobject\CompanyCheck\ResponseParserInterface;

/**
 * Class ResponseParser
 * @package Strayobject\CompanyCheck\GB
 */
class ResponseParser implements ResponseParserInterface
{
    /**
     * @var bool
     */
    private $isMulti = false;

    /**
     * @param array $response
     * @return ArrayIterator
     */
    public function parse(array $response): ArrayIterator
    {
        $data = new ArrayIterator();
        $adapter = $this->isMulti ? ResponseMultiCompanyDataAdapter::class: ResponseSingleCompanyDataAdapter::class;

        foreach ($response as $item) {
            $data->append(new $adapter($item));
        }

        return $data;
    }

    /**
     * Setter for IsMulti
     *
     * @param bool $isMulti
     * @return ResponseParser
     */
    public function setIsMulti(bool $isMulti): ResponseParser
    {
        $this->isMulti = $isMulti;

        return $this;
    }
}

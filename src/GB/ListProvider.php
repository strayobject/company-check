<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\GB;

use ArrayIterator;
use Strayobject\CompanyCheck\CompanyListProviderInterface;
use Strayobject\CompanyCheck\CompanyValidatorInterface;

/**
 * Class ListProvider
 * @package Strayobject\CompanyCheck\GB
 */
class ListProvider implements CompanyListProviderInterface
{
    use SupportTrait;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var CompanyValidatorInterface
     */
    private $numberValidator;

    /**
     * ListProvider constructor.
     * @param Client $client
     * @param CompanyValidatorInterface $numberValidator
     */
    public function __construct(Client $client, CompanyValidatorInterface $numberValidator)
    {
        $this->client = $client;
        $this->numberValidator = $numberValidator;
    }

    /**
     * @param string $name
     * @return ArrayIterator
     */
    public function getListByName(string $name): ArrayIterator
    {
        $response = $this->client->companySearch($name);

        return (new ResponseParser())->setIsMulti(true)->parse($response->items);
    }

    /**
     * @param string $number
     * @return ArrayIterator
     */
    public function getListByNumber(string $number): ArrayIterator
    {
        $response = $this->client->getCompanyProfile($number);

        return (new ResponseParser())->setIsMulti(false)->parse([$response]);
    }

    /**
     * @param string $query
     * @param string $countryCode
     * @return ArrayIterator
     */
    public function getList(string $query, string $countryCode): ArrayIterator
    {
        if ($this->numberValidator->isValidNumber($query, $countryCode)) {
            return $this->getListByNumber($query);
        }

        return $this->getListByName($query);
    }
}

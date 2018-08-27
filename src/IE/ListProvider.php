<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\IE;

use ArrayIterator;
use Strayobject\CompanyCheck\CompanyListProviderInterface;
use Strayobject\CompanyCheck\CompanyValidatorInterface;

/**
 * Class ListProvider
 * @package Strayobject\CompanyCheck\IE
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
     * @param int $number
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getListByNumber(string $number): ArrayIterator
    {
        $response = $this->client->getCompanyByNumber((int) $number);

        return (new ResponseParser())->parse($response);
    }

    /**
     * @param string $name
     * @return ArrayIterator
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getListByName(string $name): ArrayIterator
    {
        $response = $this->client->getCompanyByName($name);

        return (new ResponseParser())->parse($response);
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

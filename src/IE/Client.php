<?php
declare(strict_types=1);

namespace Strayobject\CompanyCheck\IE;

use GuzzleHttp\Client as Guzzle;
use stdClass;

/**
 * Class Client
 * @package Strayobject\CompanyCheck\CompanyRegistrationOffice
 */
class Client
{
    /**
     * @var Guzzle
     */
    private $guzzleClient;
    /**
     * @var string
     */
    private $baseUri = 'https://services.cro.ie/cws/companies';
    /**
     * @var array
     */
    private $options = [
        'company_name' => null,
        'company_num' => null,
        'company_bus_ind' => 'e',
        'address' => null,
        'skip' => null,
        'max' => null,
        'searchType' => null,
        'sortBy' => null,
        'sortDir' => null,
        'htmlEnc' => 1,
    ];

    /**
     * Client constructor.
     * @param string $email
     * @param string $key
     */
    public function __construct(string $email, string $key)
    {
        $this->guzzleClient = new Guzzle([
            'base_uri' => $this->baseUri,
            'auth' => [\base64_encode(\sprintf('%s:%s', $email, $key)), ''],
            'headers' => [
                'exceptions' => false,
                'allow_redirects' => false,
                'Accept' => 'application/json',
            ],
        ]);
    }

    /**
     * @param int $number
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyByNumber(int $number): array
    {
        return $this->getCompanyBy('company_num', $number);
    }

    /**
     * @param string $name
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyByName(string $name): array
    {
        return $this->getCompanyBy('company_name', $name);
    }

    /**
     * @param string $field
     * @param $query
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCompanyBy(string $field, $query): array
    {
        $this->options[$field] = $query;
        $res = $this->guzzleClient->request('GET', null, ['query' => $this->options]);

        return \json_decode((string) $res->getBody());
    }
}

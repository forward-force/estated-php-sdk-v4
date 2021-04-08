<?php

namespace ForwardForce\Estated;

use ForwardForce\Estated\Traits\Pagable;
use ForwardForce\Estated\Traits\Parametarable;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    use Pagable;
    use Parametarable;

    public const API_VERSION = 'v4';
    public const BASE_URL = 'https://apis.estated.com';

    /**
     * Guzzle Client
     *
     * @var Client
     */
    protected Client $client;

    /**
     * The API response
     *
     * @var ResponseInterface
     */
    protected ResponseInterface $response;

    /**
     * Num of results returned by the API call
     *
     * @var int
     */
    private int $found;

    public function __construct(string $apiKey)
    {
        $this->client = new Client(['base_uri' => self::BASE_URL . '/']);
        $this->addQueryParameter('token', $apiKey);
    }

    /**
     * Send get request
     *
     * @param  string $endpoint
     * @return array
     * @throws GuzzleException
     */
    public function get(string $endpoint): array
    {
        $this->response = $this->client->get($endpoint);
        return $this->toArray();
    }

    /**
     * Num of results returned by the API call
     *
     * @return int
     */
    public function count(): int
    {
        return $this->found;
    }

    /**
     * Parse response
     *
     * @return array
     */
    private function toArray(): array
    {
        $response = json_decode($this->response->getBody()->getContents(), true);

        if (empty($response)) {
            return [];
        }

        return $response['data'];
    }

    /**
     * Add query parameters city endpoint
     *
     * @param  string $endpoint
     * @return string
     */
    protected function buildQuery(string $endpoint): string
    {
        $endpoint = self::API_VERSION . $endpoint;
        if (empty($this->getQueryString())) {
            return $endpoint;
        }

        return $endpoint . '/?' . http_build_query($this->getQueryString());
    }
}

<?php

namespace ForwardForce\Estated;

use ForwardForce\Estated\Entities\Property;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Client as GuzzleHttpClient;

class Estated
{
    /**
     * Estated API key
     *
     * @var string
     */
    protected string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Property API Overview
     * @param string $streetAddress Field Street Address (REQUIRED)
     * @param string $city Field City (REQUIRED)
     * @param string $state Field State (REQUIRED)
     * @param string|null $zipCode Field Zip Code (OPTIONAL)
     * @deprecated
     * @return array
     * @throws GuzzleException
     */
    public function generalData(string $streetAddress, string $city, string $state, ?string $zipCode): array
    {
        try {
            $options = [
                'token' => $this->token,
                'street_address' => $streetAddress,
                'city' => $city,
                'state' => $state,
                'zip_code' => $zipCode
            ];
            $response = $this->client->get(self::BASE_URL . '/property?' . http_build_query($options));
        } catch (RequestException $e) {
            $error['request'] = Message::toString($e->getRequest());

            if ($e->hasResponse()) {
                $error['response'] = Message::toString($e->getResponse());
            }

            return $error;
        }

        return json_decode($response->getBody()->getContents() ?? [], true);
    }

    /**
     * Fetch property data from estated.com
     *
     * @param string $streetAddress
     * @param string $city
     * @param string $state
     * @param string|null $zipCode
     * @return array
     * @throws GuzzleException
     */
    public function property(string $streetAddress, string $city, string $state, ?string $zipCode): array
    {
        $property = new Property($this->token);
        return $property->setStreetAddress($streetAddress)
                ->setCity($city)
                ->setState($state)
                ->setZipCode($zipCode)
                ->fetch();
    }
}

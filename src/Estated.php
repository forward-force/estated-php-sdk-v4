<?php

namespace ForwardForce\Estated;

use ForwardForce\Estated\Entities\Property;
use GuzzleHttp\Exception\GuzzleException;

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

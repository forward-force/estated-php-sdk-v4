<?php

namespace ForwardForce\Estated\Entities;

use ForwardForce\Estated\Contracts\ApiAwareContract;
use ForwardForce\Estated\HttpClient;
use GuzzleHttp\Exception\GuzzleException;

/** @psalm-suppress PropertyNotSetInConstructor */
class Property extends HttpClient implements ApiAwareContract
{
    /**
     * Address
     * @example 151 Battle Green Dr
     *
     * @var string
     */
    protected string $streetAddress;

    /**
     * City
     * @example Rochester
     *
     * @var string
     */
    protected string $city;

    /**
     * State
     * @example NY
     *
     * @var string
     */
    protected string $state;

    /**
     * Zip Code
     * @example 14624
     *
     * @var string
     */
    protected string $zipCode;

    /**
     * @return array
     * @throws GuzzleException
     */
    public function fetch(): array
    {
        $this->addBodyParameter('city', $this->getCity());
        $this->addBodyParameter('street_address', $this->getStreetAddress());
        $this->addBodyParameter('state', $this->getState());
        $this->addBodyParameter('zip_code', $this->getZipCode());

        return $this->get($this->buildQuery('/property'));
    }

    /**
     * @return string
     */
    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    /**
     * @param string $streetAddress
     * @return Property
     */
    public function setStreetAddress(string $streetAddress): Property
    {
        $this->streetAddress = $streetAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Property
     */
    public function setCity(string $city): Property
    {
        $this->city = filter_var($city, FILTER_SANITIZE_NUMBER_INT);
        $this->city = str_replace('-', '', $this->city);
        return $this;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return Property
     */
    public function setState(string $state): Property
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return Property
     */
    public function setZipCode(string $zipCode): Property
    {
        $this->zipCode = $zipCode;
        return $this;
    }
}

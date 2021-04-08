<?php

namespace ForwardForce\Estated\Tests\Entities;

use ForwardForce\Estated\Entities\Property;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use ReflectionMethod;

class PropertyTest extends TestCase
{

    public function testFetch()
    {
        $fixture = new Property('123456');
        $fixture->setStreetAddress('151 Battle Green Dr')
            ->setCity('Rochester')
            ->setState('NY')
            ->setZipCode('14624');

        $fixture->addQueryParameter('city', $fixture->getCity());
        $fixture->addQueryParameter('street_address', $fixture->getStreetAddress());
        $fixture->addQueryParameter('city', $fixture->getCity());
        $fixture->addQueryParameter('state', $fixture->getState());
        $fixture->addQueryParameter('zip_code', $fixture->getZipCode());

        try {
            $reflector = new ReflectionMethod($fixture, 'buildQuery');
            $reflector->setAccessible(true);

            $query = $reflector->invoke($fixture, '/property');

            $correct = Property::API_VERSION . '/property/?token=123456&city=Rochester&street_address=151+Battle+Green+Dr&state=NY&zip_code=14624';
            $this->assertSame($correct, $query);
        } catch (ReflectionException $e) {
            $this->assertTrue(false);
        }
    }
}

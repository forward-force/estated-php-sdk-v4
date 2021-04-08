<?php

namespace ForwardForce\Estated\Tests;

use ForwardForce\Estated\HttpClient;
use PHPUnit\Framework\TestCase;

class HttpClientTest extends TestCase
{
    public function testBaseURL()
    {
        $fixture = new HttpClient('123456');

        try {
            $reflector = new \ReflectionProperty($fixture, 'client');
            $reflector->setAccessible(true);
            $host = $reflector->getValue($fixture)->getConfig()['base_uri']->getHost();
            $this->assertSame('apis.estated.com', $host);
        } catch (\ReflectionException $e) {
            $this->assertTrue(false);
        }
    }

    public function testBuildQuery()
    {
        try {
            $fixture = new HttpClient('123456');

            $reflector = new \ReflectionMethod($fixture, 'buildQuery');
            $reflector->setAccessible(true);

            $query = $reflector->invoke($fixture, '/test');
            $this->assertSame($fixture::API_VERSION . '/test/?token=123456', $query);

            $fixture = new HttpClient('123456');
            $fixture->addQueryParameter('foo', 'bar');
            $query = $reflector->invoke($fixture, '/test');
            $this->assertSame($fixture::API_VERSION . '/test/?token=123456&foo=bar', $query);
        } catch (\ReflectionException $e) {
            $this->assertTrue(false);
        }
    }

}

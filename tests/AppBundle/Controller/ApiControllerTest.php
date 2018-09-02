<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testGetBooks()
    {
        $client = static::createClient();
        $client->request('GET', '/api/books');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertJson( $client->getResponse()->getContent());
    }
}

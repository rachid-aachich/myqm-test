<?php
// tests/CarTests.php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CarTests extends WebTestCase
{
    public function testHomePage()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAddCar()
    {
        $client = static::createClient();

        $data = [
                    'brand' => 'Mercs',
                    'model' => 'Mers',
                    'color' => 'Mers',
                    'price' => 'Mers'
        ];

        $client->request('POST', '/', $data);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DoctorControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/doctors');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('h1', 'Nos docteurs');
    }
}

<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class UserControllerTest extends WebTestCase
{

    public function testLoginLogout()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertEquals(
          Response::HTTP_OK,
          $client->getResponse()->getStatusCode()
        );

        $form = $crawler->selectButton('login')->form();
        $form['_username'] = 'admin';
        $form['_password'] = 'admin';
        $client->submit($form);
        $crawler = $client->followRedirect();
        $request = $client->getRequest();
        $this->assertEquals("/", $request->getRequestUri());
    }
}

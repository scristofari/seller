<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IdeaControllerTest extends WebTestCase
{

    public function testLMustBeLoggedToCreateIdea()
    {
        $client = static::createClient();
        $client->request('GET', '/ideas/create');
        $client->followRedirect();
        $request = $client->getRequest();
        $this->assertEquals("/login", $request->getRequestUri());
    }
}

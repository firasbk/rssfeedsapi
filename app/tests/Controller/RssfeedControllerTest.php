<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
/*
 * Functional Test
 */
class RssfeedControllerTest extends WebTestCase
{
    public function testGetRssFeedsUrl()
    {
        $client = static::createClient();

        $client->request('GET', '/api/v1/rssfeeds');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
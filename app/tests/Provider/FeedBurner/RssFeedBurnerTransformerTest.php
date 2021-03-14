<?php

namespace App\Tests\Provider\FeedBurner;

use App\Dto\RssFeedDto;
use App\Provider\FeedBurner\FeedBurnerResponse;
use PHPUnit\Framework\TestCase;
use App\Provider\FeedBurner\RssFeedBurnerTransformer;

class RssFeedBurnerTransformerTest extends TestCase
{
    public function testTransformFromObject()
    {
        $feedBurner = new FeedBurnerResponse();
        $feedBurner->pubDate = 'Fri, 12 Mar 2021 18:01:48 +0000';
        $feedBurner->description = 'test description';
        $feedBurner->title = 'test tilte';
        $feedBurner->link = 'test link';
        $rssFeedBurnerTransformer = new RssFeedBurnerTransformer();
        $dtoActual = $rssFeedBurnerTransformer->transformFromObject($feedBurner);

        $dtoTest = new RssFeedDto();
        $dtoTest->description = 'test description';
        $dtoTest->title = 'test tilte';
        $dtoTest->webUrl = 'test link';
        $dtoTest->imgUrl = 'Not Available';
        $dtoTest->pubishedDate = new \DateTime('Fri, 12 Mar 2021 18:01:48 +0000');

        $this->assertEquals($dtoActual, $dtoTest);
    }
}

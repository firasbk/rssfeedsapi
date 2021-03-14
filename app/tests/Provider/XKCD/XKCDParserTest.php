<?php

namespace App\Tests\Provider\XKCD;

use App\Provider\XKCD\XKCDParser;
use App\Provider\XKCD\XKCDResponse;
use phpDocumentor\Reflection\Types\Object_;
use PHPUnit\Framework\TestCase;

class XKCDParserTest extends TestCase
{
    public function testGetRssFeedsByApiWithNoRecords()
    {
        $parser = new XKCDParser();
        $emptyArray = $parser->getRssFeedsByApi(0);

        self::assertEquals(array(), $emptyArray);

    }

    public function testGetRssFeedsByApi()
    {
        $parser = new XKCDParser();
        $actualResponse = $parser->getRssFeedsByApi(5);

        self::assertTrue($this->count($actualResponse) < 6);
    }
    public function testMapResponseToXKCDObject()
    {
        $xkcdResponse = new XKCDResponse();
        $xkcdResponse->img = 'image url';
        $xkcdResponse->link = 'link url';
        $xkcdResponse->safe_title =  'title';
        $xkcdResponse->transcript = 'description';
        $xkcdResponse->year = '2020';
        $xkcdResponse->month = '10';
        $xkcdResponse->day = '13';

        $parser = new XKCDParser();
        self::assertEquals($xkcdResponse, $parser->mapResponseToXKCDObject($xkcdResponse));
    }
}
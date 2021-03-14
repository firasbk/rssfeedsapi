<?php
namespace App\Provider\Conf;


class ProviderConstant
{
    public const NUMBER_OF_RECORDS_PER_API = 10;

    public const PROVIDERS_PARSER_PATHS = ['App\Provider\FeedBurner\FeedBurnerParser', 'App\Provider\XKCD\XKCDParser'];

    public const FEED_BURNER_API = 'http://feeds.feedburner.com/PoorlyDrawnLines';
    public const FEED_XKCD_API = 'http://xkcd.com/info.0.json';
}
<?php
namespace App\Provider\Conf;

/*
 * This is the Provider Constant where we should put out number of records per api and everything related to
 * apis constants to be defined
 *
 * @author Firas Bou Karroum
 */
class ProviderConstant
{
    // the number of maximum records that should be retrieved from every api provider
    public const NUMBER_OF_RECORDS_PER_API = 10;

    // this is the container of the parsers apis so to add new parser it should be added here
    public const PROVIDERS_PARSER_PATHS = ['App\Provider\FeedBurner\FeedBurnerParser', 'App\Provider\XKCD\XKCDParser'];

    // here are the provider apis , for a new api add its url here
    public const FEED_BURNER_API = 'http://feeds.feedburner.com/PoorlyDrawnLines';
    public const FEED_XKCD_API = 'http://xkcd.com/info.0.json';
}
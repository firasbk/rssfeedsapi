<?php
declare(strict_types=1);

namespace App\Service;

use App\Utils\DateSort;
use App\Provider\Conf\ProviderConstant;
class RssfeedService
{
    private array $providers = ProviderConstant::PROVIDERS_PARSER_PATHS;
    private int $apiMaxRecords = ProviderConstant::NUMBER_OF_RECORDS_PER_API;
    public function _construct() {

    }

    public function getRssFeeds() {
        $result = array();

        foreach ($this->providers as $provider){
            $parserClass = new $provider();
            $result = array_merge($result, $parserClass->getRssFeedsByApi($this->apiMaxRecords));
        }

        $sortFeeds = new DateSort();
        return  $sortFeeds->sortByPublishedDate($result);
    }

}
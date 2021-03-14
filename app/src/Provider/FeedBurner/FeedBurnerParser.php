<?php
declare(strict_types=1);

namespace App\Provider\FeedBurner;

use App\Provider\ApiProviderParserInterface;
use App\Provider\Conf\ProviderConstant;

class FeedBurnerParser implements ApiProviderParserInterface
{
    private string $apiURl = ProviderConstant::FEED_BURNER_API;
    public function getRssFeedsByApi(int $maxRecordsNumber) : array
    {
        $xmlfile = file_get_contents($this->apiURl);
        $sxml = simplexml_load_string($xmlfile, 'SimpleXMLElement', LIBXML_NOCDATA);
        $feedBurnerRecordsJson = json_encode($sxml->channel);
        $feedBurnerRecordsArray = json_decode($feedBurnerRecordsJson, true);

        $feedBurnerResponses = [];

        // we want to retrieve only the max records number from the api as stated in const
        $remainingRecordsNumbers = $maxRecordsNumber;
        foreach ( $feedBurnerRecordsArray["item"] as $item){
            if($remainingRecordsNumbers == 0){
                break;
            }
            $feedBurnerResponse = new FeedBurnerResponse();
            $feedBurnerResponse->link = $item["link"];
            $feedBurnerResponse->title = $item["title"];
            $feedBurnerResponse->guid = $item["guid"];
            if (isset($item["description"]) && !empty($item["description"])) {
                $feedBurnerResponse->description = $item["description"];
            }
            $feedBurnerResponse->pubDate = $item["pubDate"];

            // Transforming the provider object to our common DTO object
            $rssFeedBurnerTransformer = new RssFeedBurnerTransformer();
            $feedBurnerResponses[] = $rssFeedBurnerTransformer->transformFromObject($feedBurnerResponse);

            $remainingRecordsNumbers--;
        }

        return $feedBurnerResponses;
    }
}
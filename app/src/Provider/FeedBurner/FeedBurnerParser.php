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
        libxml_use_internal_errors(true);
        $xmlfile = file_get_contents($this->apiURl);
        $sxml = simplexml_load_string($xmlfile, 'SimpleXMLElement', LIBXML_NOCDATA);
        if (false === $sxml) {
            echo "Failed loading XML\n";
            foreach(libxml_get_errors() as $error) {
                echo "\t", $error->message;
            }
            return array();
        }
        $feedBurnerRecordsJson = json_encode($sxml->channel);
        $feedBurnerRecordsArray = json_decode($feedBurnerRecordsJson, true);

        $feedBurnerResponses = [];

        // we want to retrieve only the max records number from the api as stated in const
        $remainingRecordsNumbers = $maxRecordsNumber;
        foreach ( $feedBurnerRecordsArray["item"] as $item){
            if($remainingRecordsNumbers == 0){
                break;
            }

            // Transforming the provider object to our common DTO object
            $rssFeedBurnerTransformer = new RssFeedBurnerTransformer();
            $feedBurnerResponses[] = $rssFeedBurnerTransformer->transformFromObject($this->mapResponseToFeedBurnerObject($item));

            $remainingRecordsNumbers--;
        }

        return $feedBurnerResponses;
    }

    public function mapResponseToFeedBurnerObject(array $item): FeedBurnerResponse
    {
        $feedBurnerResponse = new FeedBurnerResponse();
        $feedBurnerResponse->link = (isset($item["link"]) && !empty($item["link"])) ? ($item["link"]) : '';
        $feedBurnerResponse->title = (isset($item["title"]) && !empty($item["title"])) ? ($item["title"]) : '';
        $feedBurnerResponse->guid = (isset($item["guid"]) && !empty($item["guid"])) ? ($item["guid"]) : '';
        $feedBurnerResponse->description = (isset($item["description"]) && !empty($item["description"])) ?
            $item["description"] : '';
        $feedBurnerResponse->pubDate = (isset($item["pubDate"]) && !empty($item["pubDate"])) ? $item["pubDate"]: '';

        return $feedBurnerResponse;
    }
}
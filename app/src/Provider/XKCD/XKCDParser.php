<?php
declare(strict_types=1);

namespace App\Provider\XKCD;

use App\Provider\Conf\ProviderConstant;
use Symfony\Component\HttpClient\HttpClient;
use App\Provider\ApiProviderParserInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class XKCDParser implements ApiProviderParserInterface
{
    private string $apiURL = ProviderConstant::FEED_XKCD_API;
    public function getRssFeedsByApi(int $maxRecordsNumber): array
    {
        $client = HttpClient::create();
        try {
            $response = $client->request('GET', $this->apiURL);
            $content = $response->getContent();
            $jsonContent = json_decode('['.$content.']');

            $xkcdResponses = [];
            // we want to retrieve only the max records number from the api as stated in const
            $remainingRecordsNumbers = $maxRecordsNumber;
            foreach ($jsonContent as $item){
                if($remainingRecordsNumbers == 0){
                    break;
                }
                $xkcdResponse = new XKCDResponse();
                $xkcdResponse->img = $item->img;
                if(isset($item->link) && !empty($item->link)) {
                    $xkcdResponse->link = $item->link;
                }
                $xkcdResponse->safe_title = $item->safe_title;
                $xkcdResponse->transcript =  $item->transcript;
                $xkcdResponse->year = $item->year;
                $xkcdResponse->month = $item->month;
                $xkcdResponse->day = $item->day;

                // Transforming the provider object to our common DTO object
                $rssFeedXKCDTransformer = new RssFeedXKCDTransformer();
                $xkcdResponses[] = $rssFeedXKCDTransformer->transformFromObject($xkcdResponse);

                $remainingRecordsNumbers--;
            }
            return $xkcdResponses;
        } catch (TransportExceptionInterface $e) {
            return array();
        }

    }
}
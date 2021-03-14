<?php
declare(strict_types=1);

namespace App\Provider\XKCD;

use App\Provider\Conf\ProviderConstant;
use Symfony\Component\HttpClient\HttpClient;
use App\Provider\ApiProviderParserInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
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
            $jsonContent = json_decode(sprintf('[%s]', $content));
            $xkcdResponses = [];
            // we want to retrieve only the max records number from the api as stated in const
            $remainingRecordsNumbers = $maxRecordsNumber;
            foreach ($jsonContent as $item){
                if($remainingRecordsNumbers == 0){
                    break;
                }
                // Transforming the provider object to our common DTO object
                $rssFeedXKCDTransformer = new RssFeedXKCDTransformer();
                $xkcdResponses[] = $rssFeedXKCDTransformer->transformFromObject($this->mapResponseToXKCDObject($item));

                $remainingRecordsNumbers--;
            }
            return $xkcdResponses;
        } catch (TransportExceptionInterface $e) {
            return array();
        } catch (\Exception $e) {
            return array();
        } catch (ClientExceptionInterface $e) {
            return array();
        } catch (RedirectionExceptionInterface $e) {
            return array();
        } catch (ServerExceptionInterface $e) {
            return array();
        }

    }

    public function mapResponseToXKCDObject($item): XKCDResponse
    {
        $xkcdResponse = new XKCDResponse();
        $xkcdResponse->img = (isset($item->img) && !empty($item->img)) ? $item->img : '';
        $xkcdResponse->link = (isset($item->link) && !empty($item->link)) ? $item->link : '';
        $xkcdResponse->safe_title = (isset($item->safe_title) && !empty($item->safe_title)) ? $item->safe_title : '';
        $xkcdResponse->transcript =  (isset($item->transcript) && !empty($item->transcript)) ? $item->transcript : '';
        $xkcdResponse->year = (isset($item->year) && !empty($item->year)) ? $item->year : '';
        $xkcdResponse->month = (isset($item->month) && !empty($item->month)) ? $item->month : '';
        $xkcdResponse->day = (isset($item->day) && !empty($item->day)) ? $item->day : '';

        return $xkcdResponse;
    }
}
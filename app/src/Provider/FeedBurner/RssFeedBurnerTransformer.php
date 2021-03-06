<?php
declare(strict_types=1);

namespace App\Provider\FeedBurner;

use App\Dto\RssFeedDto;
use App\Provider\AbstractResponseDtoTransformer;
use App\Provider\UnexpectedTypeException;
use DateTime;
use Exception;

class RssFeedBurnerTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param $feedBurner
     *
     * @return RssFeedDto
     * @throws Exception
     */
    public function transformFromObject($feedBurner): RssFeedDto
    {
        if (!$feedBurner instanceof FeedBurnerResponse) {
            throw new UnexpectedTypeException('Expected type of FeedBurnerResponse but got ' . \get_class($feedBurner));
        }

        $dto = new RssFeedDto();

        $dto->pubishedDate =  new DateTime($feedBurner->pubDate);
        $dto->description = (!empty($feedBurner->description)) ? $feedBurner->description : '';
        $dto->imgUrl = 'Not Available';
        $dto->title = (!empty($feedBurner->title)) ? $feedBurner->title : '';
        $dto->webUrl = (!empty($feedBurner->link)) ? $feedBurner->link : '';

        return $dto;
    }
}
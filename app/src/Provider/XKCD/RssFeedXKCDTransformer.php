<?php
declare(strict_types=1);

namespace App\Provider\XKCD;


use App\Dto\RssFeedDto;
use App\Provider\AbstractResponseDtoTransformer;
use DateTime;
use Exception;

class RssFeedXKCDTransformer extends AbstractResponseDtoTransformer
{
    /**
     * @param XKCDResponse $xKCD
     *
     * @return RssFeedDto
     * @throws Exception
     */
    public function transformFromObject($xKCD): RssFeedDto
    {
        $dto = new RssFeedDto();
        $dto->pubishedDate = new DateTime($xKCD->day.'-'.$xKCD->month.'-'.$xKCD->year);
        $dto->description = (!empty($xKCD->transcript)) ? $xKCD->transcript : '';
        $dto->imgUrl = (!empty($xKCD->img)) ? $xKCD->img : '';
        $dto->title = (!empty($xKCD->safe_title)) ? $xKCD->safe_title : '';
        $dto->webUrl = (!empty($xKCD->link)) ? $xKCD->link : '';

        return $dto;
    }
}
<?php
declare(strict_types=1);

namespace App\Dto;

use JMS\Serializer\Annotation as Serialization;

class RssFeedDto
{
    /**
     * @Serialization\Type("string")
     */
    public string $imgUrl;

    /**
     * @Serialization\Type("string")
     */
    public string $title;

    /**
     * @Serialization\Type("string")
     */
    public string $description;

    /**
     * @Serialization\Type("string")
     */
    public string $webUrl;

    /**
     * @Serialization\Type("DateTime<'Y-m-d\TH:i:s'>")
     */
    public \DateTime $pubishedDate;
}
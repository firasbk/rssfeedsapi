<?php
declare(strict_types=1);

namespace App\Provider;

interface ApiProviderParserInterface
{
    public function getRssFeedsByApi(int $maxRecordsNumber) : array;
}
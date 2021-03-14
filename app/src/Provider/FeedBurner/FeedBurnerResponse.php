<?php
declare(strict_types=1);
namespace App\Provider\FeedBurner;

class FeedBurnerResponse
{
    public string $title;
    public string $link;
    public string $pubDate;
    public string $guid;
    public string $description;
}
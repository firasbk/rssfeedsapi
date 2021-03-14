<?php
namespace App\Utils;

class DateSort
{
    public function sortByPublishedDate(array $rssFeeds) : array {
        usort($rssFeeds, function($a, $b) {
            return ($a->pubishedDate) > ($b->pubishedDate)? -1 : 1;
        });
        return $rssFeeds;
    }

}
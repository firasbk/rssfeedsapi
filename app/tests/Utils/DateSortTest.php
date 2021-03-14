<?php
namespace App\Tests\Utils;

use App\Utils\DateSort;
use PHPUnit\Framework\TestCase;
/*
 *
 *  UNIT TEST
 *
 */
class DateSortTest extends TestCase
{
    public function testSortByPublishedDate()
    {

        $dateSort = new DateSort();
        $strTest = '
        [{
        "test": "test",
        "pubishedDate": {
        "date": "2021-03-12 18:01:48.000000",
            "timezone_type": 1,
            "timezone": "+00:00"
            }
        },
        {"test": "test",
        "pubishedDate": {
        "date": "2021-03-15 18:30:48.000000",
            "timezone_type": 1,
            "timezone": "+00:00"
            }
        }]';
        $testArray = json_decode($strTest);
        $testArray = $dateSort->sortByPublishedDate($testArray);

        $strExpectedTest = '
        [{
        "test": "test",
        "pubishedDate": {
        "date": "2021-03-15 18:30:48.000000",
            "timezone_type": 1,
            "timezone": "+00:00"
            }
        },
        {"test": "test",
        "pubishedDate": {
        "date": "2021-03-12 18:01:48.000000",
            "timezone_type": 1,
            "timezone": "+00:00"
            }
        }]';
        $strExpectedTestArray = json_decode($strExpectedTest);

        $this->assertEquals( $strExpectedTestArray, $testArray);;
    }
    public function testSortByPublishedDateInverse()
    {

        $dateSort = new DateSort();
        $strTest = '
        [{
        "test": "test",
        "pubishedDate": {
        "date": "2021-03-12 18:01:48.000000",
            "timezone_type": 1,
            "timezone": "+00:00"
            }
        },
        {"test": "test",
        "pubishedDate": {
        "date": "2021-03-15 18:30:48.000000",
            "timezone_type": 1,
            "timezone": "+00:00"
            }
        }]';
        //  $strTestJson = json_encode($strTest);
        $testArray = json_decode($strTest);
        $testArray = $dateSort->sortByPublishedDate($testArray);

        $strExpectedTest = '
        [{
        "test": "test",
        "pubishedDate": {
        "date": "2021-03-12 18:01:48.000000",
            "timezone_type": 1,
            "timezone": "+00:00"
            }
        },
        {"test": "test",
        "pubishedDate": {
        "date": "2021-03-15 18:30:48.000000",
            "timezone_type": 1,
            "timezone": "+00:00"
            }
        }]';
        $strExpectedTestArray = json_decode($strExpectedTest);

        $this->assertNotEquals( $strExpectedTestArray, $testArray);
    }
}
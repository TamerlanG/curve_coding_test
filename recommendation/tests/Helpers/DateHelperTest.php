<?php


namespace Helpers;


use App\Util\Helpers\DateHelper;
use Carbon\Carbon;

class DateHelperTest extends \TestCase
{
    public function testGetPastSevenDays(){
        $dates = DateHelper::get_past_seven_days(new Carbon("2020-01-08"));

        $appropriate_response = [
            "2020-01-01",
            "2020-01-02",
            "2020-01-03",
            "2020-01-04",
            "2020-01-05",
            "2020-01-06",
            "2020-01-07"
        ];

        self::assertEquals($dates, $appropriate_response);
    }

}

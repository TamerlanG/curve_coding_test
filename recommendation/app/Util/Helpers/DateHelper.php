<?php


namespace App\Util\Helpers;


use Carbon\Carbon;
use Carbon\CarbonPeriod;

class DateHelper
{
    public static function getPastSevenDays(Carbon $current_date): array {
        // Created new copy because the subDays(7) function kept overriding the current_date
        $previous_week_date_object = $current_date->copy()->subDays(7);
        $period = CarbonPeriod::create($previous_week_date_object, $current_date);
        $dates = Self::format_period($period->toArray(), 'Y-m-d');

        // remove last element because it's current date
        array_pop($dates);

        return $dates;
    }

    public static function format_period(array $period, string $format): array{
        $dates = [];
        foreach ($period as $date){
            $dates[] = $date->toDateString();
        }

        return $dates;
    }
}

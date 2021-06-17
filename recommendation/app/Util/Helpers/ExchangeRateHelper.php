<?php


namespace App\Util\Helpers;


class ExchangeRateHelper
{
    public static function calculate_average_rates(array $data): array {
        $length = count($data);
        $averaged_rates = [];
        foreach ($data as $key => $entry){
            $rates = $entry[1];
            foreach ($rates as $currency => $rate){
               if(array_key_exists($currency,$averaged_rates)){
                   $averaged_rates[$currency] += $rate;
                   continue;
               }

               $averaged_rates[$currency] = $rate;
            }
        }

        foreach ($averaged_rates as $key => $total){
            $averaged_rates[$key] = $total / $length;
        }

        return $averaged_rates;
    }

    public static function calculate_recommendation($current_rate, $average){
        foreach ($average as $currency => $average_rate){
            if($current_rate[$currency] >= $average_rate){
                $average[$currency] = "Recommended";
                continue;
            }

            $average[$currency] = "Not Recommended";
        }

        return $average;
    }
}

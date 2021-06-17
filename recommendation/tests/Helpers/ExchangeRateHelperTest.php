<?php


namespace Helpers;


use App\Util\Helpers\ExchangeRateHelper;

class ExchangeRateHelperTest extends \TestCase
{
    public function testCalculateAverageRates(){
        $payload = [
            [
                "2021-06-09",
                [
                    "EUR" => 1,
                    "USD" => 1.21,
                    "KZT" => 520.441
                ],
            ],
            [
                "2021-06-10",
                [
                    "EUR" => 1,
                    "USD" => 1.22,
                    "KZT" => 522.23
                ],
            ],
        ];

        $appropriate_response = [
            "EUR" => 1,
            "USD" => 1.215,
            "KZT" => 521.3355,
        ];

        $response = ExchangeRateHelper::calculate_average_rates($payload);

        Self::assertEquals($appropriate_response, $response);
    }


    public function testCalculateRecommendation(){
        $current_rate = [
            "EUR" => "1.23",
            "USD" => "3.4"
        ];

        $average = [
            "EUR" => "1.23",
            "USD" => "3.50"
        ];

        $appropriate_response = [
            "EUR" => "Recommended",
            "USD" => "Not Recommended"
        ];

        $response = ExchangeRateHelper::calculate_recommendation($current_rate, $average);

        Self::assertEquals($appropriate_response, $response);
    }
}

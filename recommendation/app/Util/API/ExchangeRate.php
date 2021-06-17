<?php

namespace App\Util\API;

use App\Util\Helpers\DateHelper;
use App\Util\Helpers\ExchangeRateHelper;
use Carbon\Carbon;
use GuzzleHttp\Client;

class ExchangeRate
{
    protected $client;
    private $APP_KEY;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->APP_KEY = env('EXCHANGE_RATE_API_KEY');
    }

    public function get_recommendation(string $symbols){
        $current_rate = $this->get_rate($symbols);
        $last_seven_days = DateHelper::getPastSevenDays(Carbon::now());
        $last_seven_rates = $this->get_historic_rates($symbols, $last_seven_days);
        $average = ExchangeRateHelper::calculateAverageRates($last_seven_rates);

        foreach ($average as $currency => $average_rate){
            if($current_rate[$currency] >= $average_rate){
                $average[$currency] = "Recommended";
                continue;
            }

            $average[$currency] = "Not Recommended";
        }

        return $average;
    }

    // Due to free account the base is automatically GBP
    private function get_rate(string $symbols): array
    {
        $query = "latest?access_key=$this->APP_KEY&symbols=$symbols";

        $response = $this->client->request('GET', $query);

        $body = json_decode($response->getBody()->getContents(), true);

        return $body['rates'];
    }

    // Due to free account the base is automatically EURO
    private function get_historic_rates(string $symbols, array $dates){
        $data = [];
        foreach ($dates as $date){
            $query = "$date?access_key=$this->APP_KEY&symbols=$symbols";

            $response = $this->client->request('GET', $query);

            $body = json_decode($response->getBody()->getContents(), true);
            $data[] = [$body['date'], $body['rates']];
        }

        return $data;
    }
}

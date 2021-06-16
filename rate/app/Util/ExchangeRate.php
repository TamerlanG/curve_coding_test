<?php

namespace App\Util;

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

    public function get_rate(string $symbols): array
    {
        $query = "latest?access_key=$this->APP_KEY&symbols=$symbols";

        $response = $this->client->request('GET', $query);

        $body = json_decode($response->getBody()->getContents(), true);

        return $body['rates'];
    }
}

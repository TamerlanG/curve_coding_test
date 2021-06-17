<?php

namespace App\Services;

class RateService
{
    use \App\Traits\ConsumesExternalServices;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.rate.base_uri');
    }

    public function rate($data)
    {
        return $this->performRequest('POST', '/api/rate', $data);
    }
}

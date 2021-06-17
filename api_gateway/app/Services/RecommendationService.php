<?php

namespace App\Services;

class RecommendationService
{
    use \App\Traits\ConsumesExternalServices;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.recommendation.base_uri');
    }

    public function recommend($data)
    {
        return $this->performRequest('POST', '/api/recommend', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Services\RecommendationService;

class RecommendationController
{
    use ApiResponser;

    public $recommendation_service;

    public function __construct(RecommendationService $rate_service)
    {
        $this->recommendation_service = $rate_service;
    }

    public function recommend(Request $request){
        return $this->successResponse($this->recommendation_service->recommend($request->all()));
    }
}

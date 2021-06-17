<?php


namespace App\Http\Controllers;


use App\Services\RateService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RateController
{
    use ApiResponser;

    public $rate_service;

    public function __construct(RateService $rate_service)
    {
        $this->rate_service = $rate_service;
    }

    public function rate(Request $request){
        return $this->successResponse($this->rate_service->rate($request->all()));
    }
}

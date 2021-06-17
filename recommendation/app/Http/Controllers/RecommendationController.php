<?php

namespace App\Http\Controllers;

use App\Util\API\ExchangeRate;
use Illuminate\Http\Request;

class RecommendationController extends Controller {
    protected $exchange_rate;

    public function __construct(ExchangeRate $exchange_rate)
    {
        $this->exchange_rate = $exchange_rate;
    }

    public function recommend(Request $request){
        $this->validate_rate($request);

        $rates = $this->exchange_rate->get_recommendation($request->get("quote"));

        return response()->json($rates);
    }


    // Should definitely put this to another class
    private function validate_rate(Request $request){
        return $this->validate($request, [
            'quote' => 'string|required'
        ]);
    }
}

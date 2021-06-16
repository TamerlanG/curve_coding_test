<?php

namespace App\Http\Controllers;

use App\Util\ExchangeRate;
use Illuminate\Http\Request;

class RateController extends Controller {
    protected $exchange_rate;

    public function __construct(ExchangeRate $exchange_rate)
    {
        $this->exchange_rate = $exchange_rate;
    }

    public function rate(Request $request){
        $this->validate_rate($request);

        $rates = $this->exchange_rate->get_rate($request->get("quote"));

        return response()->json($rates);
    }


    // Should definitely put this to another class
    private function validate_rate(Request $request){
        return $this->validate($request, [
           'quote' => 'string|required'
        ]);
    }
}

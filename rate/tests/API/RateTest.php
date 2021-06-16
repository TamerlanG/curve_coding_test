<?php

class RateTest extends TestCase
{
    public function testShouldShowValidationError(){
        $this->post('/api/rate', []);

        $this->seeStatusCode(422);
        $this->seeJson([
            'quote' => ["The quote field is required."]
        ]);
    }

    /*
     * TODO: Mock Third Party API
     */
    public function testShouldShowCorrentResponse(){
        $this->post('/api/rate', ["quote" => 'EUR, USD, SAR, KZT']);

        $this->seeStatusCode(200);

        $this->seeJsonStructure([
            "EUR",
            "USD",
            "SAR",
            "KZT"
        ]);
    }

}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CurrencyCalculatorControllerTest extends TestCase
{
//    /** @test */
   public function update_currency_rates_route_can_be_accessed()
   {
       $response = $this->get('/update-currency-rates');

       $response->assertStatus(200);
       // Add more assertions here to check the expected behavior
   }

   /** @test */
   public function currency_calculator_page_loads_successfully()
   {
       $response = $this->get(route('currency.calculator'));

       $response->assertStatus(200);
       $response->assertViewIs('currency_calculator');

   }

//    /** @test */
   public function currency_convert_function_returns_expected_results()
   {

       $requestData = [
           'amount' => 100,
           'from_currency' => 'USD',
           'to_currency' => 'EUR'
       ];

       $response = $this->post(route('currency.convert'), $requestData);

       $response->assertStatus(200);
       $response->assertJsonStructure([
           'converted_amount',
           'from_currency',
           'to_currency',
           'rate'
       ]);
       // Add more assertions here to verify the conversion logic
   }
}

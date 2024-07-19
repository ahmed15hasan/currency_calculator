<?php

namespace App\Http\Controllers;

use App\Models\CurrencyRate;
use Illuminate\Http\Request;
use App\Services\ApiService;
use Exception;

class CurrencyCalculatorController extends Controller
{
    protected $apiKey;
    protected $apiUrl;
    protected $apiService;


    public function __construct(ApiService $apiService) // Inject the ApiService into the controller
    {
        $this->apiKey = env('CURRENCY_EXCHANGE_API_KEY'); // Retrieve API key from .env file
        $this->apiService = $apiService;
        $this->apiUrl = env('CURRENCY_EXCHANGE_API_URL');
    }

    public function index()
    {
        $supportedCurrencies = config('currency_list.currencies');

        return view('currency_calculator',compact('supportedCurrencies'));
    }
 

    public function convert(Request $request)
    {

        try {

            $currency_endpoint = env('CURRENCY_EXCHANGE_API_URL');

            $request->validate([
                'currency_amount' => 'required|numeric',
                'from_currency' => 'required',
                'to_currency' => 'required',
            ]);

            $fromCurrency = $request->from_currency;
            $toCurrency = $request->to_currency;
            $amount = $request->currency_amount;

            $rates = CurrencyRate::all()->pluck('rate', 'currency_code')->toArray();

            if (!isset($rates[$fromCurrency]) || !isset($rates[$toCurrency])) {
                return ['error' => 'Currency not found'];
            }

           // Convert amount from $fromCurrency to $toCurrency
            $usdAmount = $amount / $rates[$fromCurrency];
            $convertedAmount = $usdAmount * $rates[$toCurrency];

            return redirect()->route('currency.calculator')
            ->with('converted_amount', number_format($convertedAmount, 2))
            ->with('from_currency', $fromCurrency)
            ->with('to_currency', $toCurrency)
            ->with('original_amount', $amount);

        } catch (\Exception $e) {
            // Handle Guzzle HTTP client exceptions
            return null;
        }


    }
}

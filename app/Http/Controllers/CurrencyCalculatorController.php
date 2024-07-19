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
        $this->apiUrl = env('CURRENCY_EXCHANGE_API_URL');;
    }

    public function index()
    {
        $supportedCurrencies = config('currency_list.currencies');

        return view('currency_calculator',compact('supportedCurrencies'));
    }

    public function updateCurrencyRates()
    {
        try {
            $param = [
                'apikey' => $this->apiKey
            ];

            // Fetch currency rates from the API
            $rates = $this->apiService->callExternalApi($this->apiUrl, 'GET', $param);

            if (isset($rates['error'])) {
                return response()->json($rates, 500);
            }

            // Update or insert currency rates into the database
            foreach ($rates['data'] as $code => $rate) {
                CurrencyRate::updateOrCreate(
                    ['currency_code' => $code],
                    ['rate' => $rate]
                );
            }

            return response()->json(['status' => 'Currency rates updated successfully.'], 200);

        } catch (Exception $e) {
            // Handle exception
            return response()->json([
                'error' => 'Failed to update currency rates.',
                'message' => $e->getMessage()
            ], 500);
        }
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

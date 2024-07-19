<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Services\ApiService;
use App\Models\CurrencyRate;
use Exception;


class UpdateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update-rates';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hit the URL to update currency rates';


    /**
     * Execute the console command.
     */
    public function handle(ApiService $apiService)
    {
        try {
            $apiKey = config('services.currency_exchange.api_key');
            $apiUrl = config('services.currency_exchange.api_url');

            $param = [
                'apikey' => $apiKey
            ];

            $rates = $apiService->callExternalApi($apiUrl, 'GET', $param);

            if (isset($rates['error'])) {
                $this->error('Failed to fetch currency rates: ' . $rates['error']);
                return 1;
            }

            // Update or insert currency rates into the database
            foreach ($rates['data'] as $code => $rate) {
                CurrencyRate::updateOrCreate(
                    ['currency_code' => $code],
                    ['rate' => $rate]
                );
            }

            $this->info('Currency rates updated successfully.');
            return true;

        } catch (Exception $e) {
            // Handle exception
            $this->error('Failed to update currency rates: ' . $e->getMessage());
            return false;
        }
    }
}

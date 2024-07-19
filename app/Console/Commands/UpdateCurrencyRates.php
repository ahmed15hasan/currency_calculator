<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;



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
    public function handle()
    {
        $response = Http::get(config('app.url') . '/update-currency-rates');

        if ($response->successful()) {
            $this->info('Currency rates updated successfully.');
        } else {
            $this->error('Failed to update currency rates.');
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Models\CurrencyRate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateCurrencyRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:currency-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency rates';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');

        $rates = $response->json()['rates'];

        foreach ($rates as $currency => $rate) {
            CurrencyRate::updateOrCreate(['currency' => $currency], ['rate' => $rate]);
        }

        $this->info('Currency rates updated successfully.');
    }
}

<?php

namespace App\Console\Commands;

use App\Models\ConvertCurrency;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetCurrencyRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $response = Http::get('https://api.exchangeratesapi.io/latest?base=USD');
        $responseJson = $response->json();

        $rate = ConvertCurrency::firstOrCreate(['id' => 'USD:EUR']);
        $rate->rate = $responseJson['rates']['EUR'];
        $rate->save();

        return true;
    }
}

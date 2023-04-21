<?php declare(strict_types=1);

namespace App;

use App\Models\CurrencyToConvert;
use GuzzleHttp\Client;

class BankApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getRate(string $currencyToConvert): CurrencyToConvert
    {
        $url = "https://www.latvijasbanka.lv/vk/ecb.xml";
        $response = $this->client->request('GET', $url);
        $ecbData = simplexml_load_string($response->getBody()->getContents());

        $currencyData = [];

        foreach ($ecbData->Currencies->Currency as $currency) {
            if ($currency->ID == $currencyToConvert) {
                $currencyData[] = $currency;
                break;
            }
        }
        if (!$currencyData) {
            echo "\n\033[94m Wrong currency\033[0m\n\n";
            exit;
        }
        return new CurrencyToConvert(
            (string)$currencyData[0]->ID,
            (float)$currencyData[0]->Rate
        );
    }
}
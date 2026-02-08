<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class BitcoinPriceCoingeckoService
{
    public function __construct(private readonly HttpClientInterface $client)
    {
    }

    public function getPrice(): float
    {
// API (CoinGecko)
        $url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd";

        $response = $this->client->request('GET', $url);
        $data = $response->toArray();


        return $data['bitcoin']['usd'];
    }
}
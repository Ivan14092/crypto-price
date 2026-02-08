<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:bitcoin:price',
    description: 'Показує поточну ціну Bitcoin',
)]
class BitcoinPriceCommand extends Command
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        parent::__construct();
        $this->client = $client;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // API (CoinGecko)
        $url = "https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd";

        $response = $this->client->request('GET', $url);
        $data = $response->toArray();

        $price = $data['bitcoin']['usd'];

        $output->writeln("💰 Поточна ціна Bitcoin: $price USD");

        return Command::SUCCESS;
    }
}
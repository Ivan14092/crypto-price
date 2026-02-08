<?php

namespace App\Command;

use App\Service\BitcoinPriceCoingeckoService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:bitcoin:price',
    description: 'Показує поточну ціну Bitcoin',
)]
class BitcoinPriceCommand extends Command
{
    public function __construct(private BitcoinPriceCoingeckoService $bitcoinPriceService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $price = $this->bitcoinPriceService->getPrice();
        $output->writeln("💰 Поточна ціна Bitcoin: $price USD");
        return Command::SUCCESS;
    }
}
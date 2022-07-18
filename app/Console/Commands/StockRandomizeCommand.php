<?php

namespace App\Console\Commands;

use App\Lib\Stock\ProductStockRandomize;
use Illuminate\Console\Command;

/**
 * App\Console\Commands\StockRandomizeCommand
 *
 * @Class StockRandomizeCommand Наполнение каталога товаров случайными остатками.
 * @package App\Console\Commands
 */
class StockRandomizeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:randomize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Наполнение каталога товаров случайными остатками.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $stockRandom = new ProductStockRandomize;
        $stockRandom();

        return 0;
    }
}

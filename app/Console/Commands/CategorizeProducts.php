<?php

namespace App\Console\Commands;

use App\Models\Products;
use Illuminate\Console\Command;

class CategorizeProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:categorize {name? : The product name to categorize} {--all : Categorize all products}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Categorize products as fruits or vegetables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('all')) {
            $products = Products::whereNull('category')->get();
            
            if ($products->isEmpty()) {
                $this->info('No uncategorized products found.');
                return;
            }

            $this->info('Found ' . $products->count() . ' uncategorized products.');
            
            foreach ($products as $product) {
                $this->categorizeProduct($product);
            }
            
            return;
        }

        $name = $this->argument('name');
        if (!$name) {
            $this->error('Please provide a product name or use --all option');
            return;
        }

        $product = Products::where('name', 'like', "%{$name}%")->first();
        if (!$product) {
            $this->error("Product not found: {$name}");
            return;
        }

        $this->categorizeProduct($product);
    }

    private function categorizeProduct(Products $product)
    {
        $this->info("Product: {$product->name}");
        $category = $this->choice(
            'Choose category',
            ['fruit', 'vegetable'],
            null
        );

        $product->category = $category;
        $product->save();

        $this->info("Successfully categorized {$product->name} as {$category}");
    }
}

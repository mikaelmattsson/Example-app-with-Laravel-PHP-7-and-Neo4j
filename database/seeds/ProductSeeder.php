<?php

use Illuminate\Database\Seeder;
use NeoShop\Entity\Product\Product;
use Vinelab\NeoEloquent\Facade\Neo4jSchema;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Neo4jSchema::dropIfExists('Product');

        Product::create(['title' => 'Product 1', 'price' => 100]);
        Product::create(['title' => 'Product 2', 'price' => 100]);
        Product::create(['title' => 'Product 3', 'price' => 100]);
        Product::create(['title' => 'Product 4', 'price' => 100]);
    }
}
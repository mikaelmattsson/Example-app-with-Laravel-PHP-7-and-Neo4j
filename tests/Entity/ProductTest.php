<?php

use NeoShop\Entity\Product\Product;
use NeoShop\Entity\Product\ProductRepository;

class ProductTest extends TestCase
{

    public function testCreateProduct()
    {
        $application = $this->createApplication();

        /** @var ProductRepository $productRepository */
        $productRepository = $application->make(ProductRepository::class);

        $model = $productRepository->create(['name'=> 'test']);

        $this->assertInstanceOf(Product::class, $model);
    }
}

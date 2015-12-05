<?php

namespace NeoShop\Entity\Product;

use NeoShop\Entity\Base\Repository;

class ProductRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model() : string
    {
        return Product::class;
    }
}
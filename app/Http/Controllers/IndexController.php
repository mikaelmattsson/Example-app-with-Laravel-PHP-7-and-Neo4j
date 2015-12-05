<?php

namespace NeoShop\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use NeoShop\Model\Product;

class IndexController extends BaseController
{

    public function indexAction()
    {
        $products = Product::all();

        return view('index', ['products' => $products]);
    }
}
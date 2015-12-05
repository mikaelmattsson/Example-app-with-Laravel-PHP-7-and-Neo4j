<?php

namespace NeoShop\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use NeoShop\Entity\Product\ProductRepository;

class IndexController extends BaseController
{

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * IndexController constructor.
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return \Illuminate\View\View
     */
    public function indexAction()
    {
        $products = $this->productRepository->all();

        return view('index', ['products' => $products]);
    }
}
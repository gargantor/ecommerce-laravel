<?php

namespace App\Http\Controllers\Site;

use Cart;
use App\Contracts\AttributeContract;
use App\Contracts\ProductContract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $productRepository;
    protected $attributeRepository;

    public function __construct(ProductContract $productRepository, AttributeContract $attributeRepository)
    {
        $this->productRepository = $productRepository;
        $this->attributeRepository = $attributeRepository;
    }

    public function show($slug)
    {
        $product = $this->productRepository->findProductBySlug($slug);
        $attributes = $this->attributeRepository->listAttributes();

        //dd($product);
        return view('site.pages.product', compact('product', 'attributes'));
    }

    public function addToCart(Request $request)
    {

        $product = $this->productRepository->findProductById($request->input('productId'));
        $options = $request->except('_token', 'productId', 'price', 'qty');

        Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);

        //dd($options);
        return redirect()->back()->with('message', 'Item added to cart successfully');
    }
}

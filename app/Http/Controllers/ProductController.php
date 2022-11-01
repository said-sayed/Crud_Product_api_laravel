<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    private $productModel;
    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }
    public function index()
    {
        $products = $this->productModel->get();

        return view('index', compact(['products']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'productName' => 'required|min:3',
            'productCategory' => 'required|min:3',
            'productPrice' => 'required|min:3',
            'productDescription' => 'required|min:7',
        ]);

        $this->productModel::create([
            'productName' => $request->productName,
            'productCategory' => $request->productCategory,
            'productPrice' => $request->productPrice,
            'productDescription' => $request->productDescription,
        ]);

        session()->flash('done', 'Product Was Added');
        return redirect()->back();
    }

    public function update(Request $request, Product $product)
    {
        dd($request);
    }
    public function search(Request $request)
    {
        $products = $this->productModel->where('productName', 'LIKE', '%' . $request->search . '%')->get();


        // dd($products->get());
        return view('index', compact(['products']));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ApiProductController extends Controller
{
    //
    private $productModel;
    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }
    public function index()
    {
        $products = $this->productModel->paginate(5);

        return ProductResource::collection($products);
    }
    public function search(Request $request)
    {
        $products = $this->productModel->where("productName", 'LIKE', '%' . $request->search . '%')->paginate(5);

        // $products where('productName' , 'LIKE', '%' . $value . '%')->get();
        return ProductResource::collection($products);
    }
    public function show(Product $product)
    {
        // $product = $this->productModel->find($id);

        return new ProductResource($product);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
               'productName' => 'required|min:3',
                'productCategory' => 'required|min:3',
                'productPrice' => 'required|min:3',
                'productDescription' => 'required|min:7',
            ]);


        $this->productModel::create($data);

        return response()->json([
            'success' => 'Product was Add Successfully',
        ]);
    }

    public function update(Request $request, $id)
    {
     
        $request->validate([
            'productName' => 'required|min:3',
            'productCategory' => 'required|min:3',
            'productPrice' => 'required|min:3',
            'productDescription' => 'required|min:7',
        ]);
        

        $updateProduct = $this->productModel->find($id);

        if ($updateProduct) {
            
            $updateProduct->update([
                'productName' => $request->productName,
                'productCategory' => $request->productCategory,
                'productPrice' => $request->productPrice,
                'productDescription' => $request->productDescription,
            ]);
            return response()->json([
                'success' => 'Product was Updated Successfully'
            ]);
        }
    }

    public function delete($id)
    {
        $deleteProduct = $this->productModel->find($id);
        if ($deleteProduct) {
            $deleteProduct->delete();
            return response()->json([
                'success' => 'Product was Deleted Successfully'

            ]);
        }
    }
}

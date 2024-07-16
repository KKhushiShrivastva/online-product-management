<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    public function manageProduct(){
        $products = Product::get();
        Log::info('products :'.json_encode($products));
        return Inertia::render('frontend/manage-product',[
            'products' => $products,
        ]);
    }
    public function getProducts()
    {
        $products = Product::get();
        return response()->json(['products' => $products]);
    }
    public function editProducts($id)
    {
        $product = Product::where('id',$id)->get();
        return response()->json(['product' => $product]);
    }


    public function create()
    {
        return Inertia::render('products/create-product');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return Inertia::render('products/edit-product', [
            'product' => $product,
        ]);
    }



    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product);
    }

    public function show($id)
    {
        return response()->json(Product::findOrFail($id));
    }

   

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['success' => true]);
    }
}

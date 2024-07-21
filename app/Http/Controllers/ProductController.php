<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function manageProduct()
    {
        $products = Product::get();
        return Inertia::render('products/manage-product', [
            'products' => $products,
        ]);
    }

    public function getProducts()
    {
        $products = Product::orderBy('created_at','desc')->get();
        return response()->json(['products' => $products]);
    }

    public function createProduct()
    {
        return Inertia::render('products/create-product');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        Log::info($product);
        return Inertia::render('products/edit-product', [
            'product' => $product,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'stock' => 'required|integer',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = new Product($validated);

        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $product_image = time() . '.' . $file->extension();
            $file->move(public_path('product_image'), $product_image);
            $product->product_image = $product_image;
        }

        $product->save();

        return response()->json($product, 201);
    }

    public function update(Request $request, $id)
    {
        // Log::info("sjdhjhd: ".json_encode($request->all()));

        Log::info('has file : ' . json_encode($request->hasFile('product_image')));
        $product = Product::findOrFail($id);
        // Log::info("product found: ".json_encode($product));
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'price' => 'required|numeric',
        //     'description' => 'required|string',
        //     'stock' => 'required|integer',
        //     'product_image' => 'nullable|image|max:2048',
        // ]);

        // $product->update($product);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $oldImageName = $product->product_image;
        // checking if image
        if ($request->hasFile('product_image')) {           
            $file = $request->file('product_image');
            $product_image = time() . '.' . $file->extension();
            Log::info("new product_image name: ".json_encode($product_image));
            $file->move(public_path('product_image'), $product_image);
            $product->product_image = $product_image;
            Log::info("product_image found: ".json_encode($product_image));
            // checking for older image exist or not
            $oldImagePath = public_path('product_image/' . $oldImageName);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }
        $product->save();
        Log::info("product_image saved: ".json_encode($product));
        return response()->json($product);
    }

  public function show($id)
    {
        $product = Product::findOrFail($id);
        Log::info($product);
        return Inertia::render('products/show-product', [
            'product' => $product,
        ]);
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['success' => true]);
    }
}

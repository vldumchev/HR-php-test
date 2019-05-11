<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.list', ['products' => Product::with('vendor')->paginate(25)]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $price   = $request->input('price');

        if (isset($price)) {
            $product->price = $price;
            $product->save();
        }

        return response()->json($product);
    }
}

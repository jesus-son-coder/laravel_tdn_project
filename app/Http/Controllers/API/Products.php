<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class Products extends Controller
{
    public function save(Request $request)
    {
        //return Product::all();
        $product = new Product();
        $product->name = $request->name;
        $product->category = $request->category;
        $product->price = $request->price;
        if( $product->save()) {
            return ['Result' => "Product has been successfully saved"];
        }
        return ['Result' => "An error occurred..."];
    }
}

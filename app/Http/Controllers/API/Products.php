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

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        if(isset($request->name)) {
            $product->name =  $request->name;
        }
        if(isset($request->category)) {
            $product->category =  $request->category;
        }
        if(isset($request->price)) {
            $product->price =  $request->price;
        }

        if( $product->save()) {
            return ['Result' => "Product has been successfully updated"];
        }
        return ['Result' => "An error occurred..."];
    }
}

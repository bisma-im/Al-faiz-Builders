<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function showProducts(){
        $products = DB::table('products')->get();
        return view('pages.products', ['data' => $products]);
    }

    public function addProduct(Request $req){
        // Retrieve data from request
        $productName = $req->input('product_name');
        $price = $req->input('price');
        $sku = $req->input('sku');
        $quantity = $req->input('shelf');
        $status = $req->input('status');
        // Add any other fields you have

        try {
            // Insert data into database
            $inserted = DB::table('products')->insert([
                'product_name' => $productName,
                'price' => $price,
                'SKU' => $sku,
                'quantity' => $quantity,
                'status' => $status,
                'image' => 'N/A',
            ]);

            return response()->json(['success' => 'Product added successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

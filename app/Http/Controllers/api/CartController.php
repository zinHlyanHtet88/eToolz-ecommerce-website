<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    // add item to cart
    public function addItemToCart (Request $request) {
        $data = [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'sub_total' => $request->subTotal
        ];
        Cart::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    // get cart list
    public function cartList (Request $request) {
        $carts = Cart::select('carts.*', 'products.name as product_name', 'products.image as product_image')
                        ->where('user_id', $request->userId)
                        ->leftJoin('products', 'products.id', '=', 'carts.product_id')
                        ->get();
    return response()->json([
        'carts' => $carts
    ]);
    }

    // delete cart
    public function deleteCart (Request $request) {
        Cart::where('id', $request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    //update cart
    public function updateCart (Request $request) {
        $data = [
            'quantity' => $request->quantity,
            'sub_total' => $request->subTotal
        ];
        Cart::where('id', $request->id)->update($data);
        $updatedCarts = Cart::select('carts.*', 'products.name as product_name', 'products.image as product_image')
                        ->where('user_id', $request->userId)
                        ->leftJoin('products', 'products.id', '=', 'carts.product_id')
                        ->get();
        return response()->json([
            'updatedCarts' => $updatedCarts
        ]);
    }
}

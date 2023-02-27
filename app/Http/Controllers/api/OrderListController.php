<?php

namespace App\Http\Controllers\api;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderListController extends Controller
{
    // add to orderlists
    public function addOrderList (Request $request) {
        foreach ($request->orders as $order) {
            $data1 = [
                'user_id' => $order['user_id'],
                'product_id' => $order['product_id'],
                'quantity' => $order['quantity'],
                'total_price' => $order['sub_total'],
                'order_code' => 'POS' . $request->orderCode
            ];
            OrderList::create($data1);
        }
        $data2 = [
            'user_id' => $request->userId,
            'order_code' => 'POS' . $request->orderCode,
            'total_price'=> $request->totalPrice
        ];
        Order::create($data2);
        Cart::where('user_id', $request->userId)->delete();
        return response()->json([
            'status' => 'success'
        ]);
        // logger($request->all());
    }

    // get order lists
    public function getOrderLists (Request $request) {
        $query = DB::table('order_Lists');
        if ($request->has('search')) {
            $query->where('order_code', 'like', '%'.request('search').'%');
            $orderLists = $query->select('order_lists.*', 'products.name as product_name', 'users.name as user_name')
                                ->leftJoin('users', 'users.id', '=', 'order_lists.user_id')
                                ->leftJoin('products', 'products.id', '=', 'order_lists.product_id')
                                ->paginate(3);
        } else {
            $orderLists = $query->select('order_lists.*', 'products.name as product_name', 'users.name as user_name')
                                ->leftJoin('users', 'users.id', '=', 'order_lists.user_id')
                                ->leftJoin('products', 'products.id', '=', 'order_lists.product_id')
                                ->paginate(3);
        }
        return response()->json([
            'orderLists' => $orderLists
        ]);

    }

    // search by value with search box
    public function searchByValue (Request $request) {
        $orderLists = OrderList::when($request->searchValue, function ($query) {
                        $query->where('order_code', 'like', '%'.request('searchValue').'%');
                    })->get();
        return response()->json([
            'orderLists' => $orderLists
        ]);
    }
}

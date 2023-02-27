<?php

namespace App\Http\Controllers\api;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // get orders
    public function list(Request $request)
    {
        $query = DB::table('orders');
        if ($request->has('search')) {
            $query->where('order_code', 'like', '%' . request('search') . '%');
            $orders = $query->paginate(5);
        }
        $orders = $query->select('orders.*', 'users.name as user_name')
                        ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                        ->paginate(5);
        return response()->json([
            'orders' => $orders
        ]);
    }

    // search order code by search box
    public function search(Request $request)
    {
        $orders = Order::when($request->searchValue, function ($query) {
            $query->where('order_code', 'like', '%' . request('searchValue') . '%');
        })->get();
        return response()->json([
            'orders' => $orders
        ]);
    }

    // update order status
    public function statusUpdate(Request $request)
    {
        $data = [
            'status' => $request->status
        ];
        Order::where('id', $request->orderId)->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    // delete order
    public function deleteOrder(Request $request)
    {
        Order::where('order_code', $request->orderCode)->delete();
        OrderList::where('order_code', $request->orderCode)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}

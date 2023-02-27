<?php

namespace App\Http\Controllers\api;

use App\Models\User;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // get users
    public function getUsers () {
        $users = Order::select('orders.user_id', 'users.name as user_name')
                    ->leftJoin('users', 'users.id', '=', 'orders.user_id')
                    ->get();
        return response()->json([
            'users' => $users
        ]);
    }

    // get order for notification
    public function getOrdersForNotification (Request $request) {
        $orders = Order::where('user_id', $request->userId)->get();
        $orderLists = OrderList::select('order_lists.*', 'products.price as product_price', 'products.name as product_name', 'products.image as product_image')
                        ->where('order_lists.user_id', $request->userId)
                        ->leftJoin('products', 'products.id', '=', 'order_lists.product_id')
                        ->get();
    return response()->json([
        'orders' => $orders,
        'orderLists' => $orderLists
    ]);
    }

    // get user with its id
    public function getUser (Request $request) {
        $user = User::where('id', $request->userId)->first();
        return response()->json([
            'user' => $user
        ]);
    }

    // update user profile
    public function updateProfile (Request $request) {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender
        ];
        if ($request->hasFile('image')) {
            $oldImage = User::where('id', $request->id)->first();
            $oldImage = $oldImage->image;
            Storage::delete('public/image/profileImages/' . $oldImage);

            $newImage = uniqid(). '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/image/profileImages', $newImage);
            $data['image'] = $newImage;
        };
        User::where('id', $request->id)->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    // phone validation
    public function phoneValidation (Request $request) {
        $users = User::where('id', '!=', $request->id)->get();
        return response()->json([
            'users' => $users
        ]);
    }

    // change user password
    public function changePassword (Request $request) {
        $oldPassword = $request->oldPassword;
        $dbPassword = User::where('id', $request->userId)->first();
        $dbPassword = $dbPassword->password;
        if (Hash::check($oldPassword, $dbPassword)) {
            User::where('id', $request->userId)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            return response()->json([
                'status' => 'success'
            ]);
        }
    }

    // get logged in user password
    public function getLoggedInUserPassword (Request $request) {
        $password = User::where('id', $request->userId)->first();
        $password = $password->password;
        return response()->json([
            'password' => $password
        ]);
    }
}

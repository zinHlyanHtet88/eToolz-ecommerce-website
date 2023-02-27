<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderListController extends Controller
{
    // direct order lists
    public function list () {
        return view('admin.orderList.list');
    }
}

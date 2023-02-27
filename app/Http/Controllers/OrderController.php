<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    // direct to orders list 
    public function list () {
        return view('admin.order.list');
    }
}

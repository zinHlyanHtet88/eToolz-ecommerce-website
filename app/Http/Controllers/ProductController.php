<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // direct to products page
    public function list () {
        return view('admin.products.list');
    }

    // direct to products add page
    public function addPage () {
        return view('admin.products.add');
    }

    // direct to product edit Page
    public function editPage () {
        return view('admin.products.edit');
    }

    // direct to product review page
    public function reviewPage () {
        return view('admin.products.review');
    }

    // direct to discount product page
    public function discountProduct () {
        return view('admin.products.discount');
    }

    // direct to user all list page
    public function allListPage () {
        $categories = Category::select('name')->get();
        return view('user.products.allList', compact('categories'));
    }

    // direct to user's product detail page
    public function productDetailPage () {
        return view('user.products.detail');
    }

    // direct to user's cart list
    public function cartList () {
        return view('user.cart.index');
    }
}

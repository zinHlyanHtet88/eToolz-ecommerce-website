<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // dashboard
    public function dashboard () {
        if (Auth::user()->role == 'admin') {
            return view('admin.category.list');
        } else {
            $categories = Category::select('name')->get();
            return view('user.home.index', compact('categories'));
        }
    }

    public function welcome () {
        $categories = Category::select('name')->get();
        return view('user.home.index', compact('categories'));
    }
}

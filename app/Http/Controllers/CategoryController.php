<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct to category page
    public function listPage () {
        $categories = Category::orderBy('created_at', 'desc')->paginate(4);
        return view('admin.category.list', compact('categories'));
    }

    // direct to category create page
    public function createPage () {
        return view('admin.category.create');
    }

    // direct to category edit page
    public function editPage () {
        return view('admin.category.edit');
    }

    // direct to category review page
    public function reviewPage () {
        return view('admin.category.review');
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    //category paginate
    public function paginate (Request $request) {
        $query = DB::table('categories');
        if ($request->has('search')) {
            $query->where('name', 'like', '%'.request('search').'%');
        }
        $category = $query->paginate(5);
        return response()->json([
            'category' => $category
        ], 200);
    }

    // category list
    public function list () {
        $category = Category::get();
        return response()->json([
            'category' => $category
        ]);
    }

    // working on creating category
    public function createCategory (Request $request) {
        $imgName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/image/category', $imgName);
        $data = [
            'name' => $request->name,
            'image' => $imgName,
            'description' => $request->description
        ];
        Category::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    // working on deleting category
    public function deleteCategory (Request $request) {
        $id = $request->id;
        $imgName = $request->imgName;
        Storage::delete('public/image/category/' . $imgName);
        Category::where('id', $id)->delete();
        $categories = Category::paginate(5);
        return response()->json([
            'status' => 'success',
        ]);
    }

    // working on getting a category with its id for edit page
    public function getCategoryWithId (Request $request) {
        $category = Category::where('id', $request->id)->first();
        return response()->json([
            'category' => $category
        ]);
    }

    // working on updating category
    public function updateCategory (Request $request) {
        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];
        if ($request->hasFile('image')) {
            $oldImage = Category::where('id', $request->id)->first();
            $oldImage = $oldImage->image;
            Storage::delete('public/image/category/' . $oldImage);
            $newImage = uniqid(). '_' . $request->file('image')->getClientOriginalName();
            $request->image->storeAs('public/image/category/', $newImage);
            $data['image'] = $newImage;
        };
        Category::where('id', $request->id)->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    // working on getting categories by search value
    public function getCategoriesBySearchValue (Request $request) {
        $categories = Category::when($request->value, function ($query) {
            $query->where('name', 'like', '%'.request('value').'%');
        })
            ->get();
        return response()->json([
            'status' => 'success',
            'categories' => $categories
        ]);
    }

}

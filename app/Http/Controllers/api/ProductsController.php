<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ProductsController extends Controller
{
    // working on creating a product
    public function createProduct (Request $request) {
        $imgName = uniqid().'_'. $request->image->getClientOriginalName();
        $request->image->storeAs('public/image/product', $imgName);
        $data = [
            'category_name' => $request->categoryName,
            'name' => $request->name,
            'price' => $request->price,
            'sim' => $request->sim,
            'storage' => $request->storage,
            'processor' => $request->processor,
            'size' => $request->size,
            'description' => $request->description,
            'memory' => $request->memory,
            'image' => $imgName
        ];
        Product::create($data);

            return response()->json([
                'status' => 'success'
            ]);
    }

    // getting products data
    public function list () {
        $products = Product::get();
        return response()->json([
            'products' => $products
        ]);
    }

    // get products data by category name
    public function categorySearch (Request $request) {
        if ($request->categoryName == 'all') {
            $sameCategoryProducts = Product::paginate(5);
        } else if ($request->categoryName == 'discountProducts') {
            $sameCategoryProducts = Product::where('normal_price', '!=' ,null)->paginate(5);
        } else {
            $sameCategoryProducts = Product::where('category_name', $request->categoryName)->paginate(5);
        }
        $sameCategoryProduct = Product::where('category_name', $request->categoryName)->first();
        return response()->json([
            'sameCategoryProducts' => $sameCategoryProducts,
            'sameCategoryProduct' => $sameCategoryProduct
        ]);
        // logger($sameCategoryProducts);
    }

    // working on deleting product
    public function deleteProduct (Request $request) {
        $oldImage = Product::where('id', $request->id)->first();
        $oldImage = $oldImage->image;
        Storage::delete('public/image/product/' . $oldImage);
        Product::where('id', $request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    // working on getting a product for editing product
    public function getProductWithId (Request $request) {
        $product = Product::where('id', $request->id)->first();
        return response()->json([
            'product' => $product
        ]);
    }

    // working on updating product
    public function updateProduct (Request $request) {
        $data = [
            'name' => $request->name,
            'category_name' => $request->categoryName,
            'price' => $request->price,
            'sim' => $request->sim,
            'storage' => $request->storage,
            'processor' => $request->processor,
            'size' => $request->size,
            'description' => $request->description,
            'memory' => $request->memory,
        ];
        if ($request->hasFile('image')) {
            $oldImage = Product::where('id', $request->id)->first();
            $oldImage = $oldImage->image;
            Storage::delete('public/image/product/' . $oldImage);

            $newImage = uniqid(). '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/image/product/', $newImage);
            $data['image'] = $newImage;
        };
        Product::where('id', $request->id)->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    // working on searching product by search value
    public function searchProductByValue (Request $request) {
        $products = Product::when($request->search, function($query) {
            $query->orWhere('name', 'like', '%'.request('search').'%')
                ->orWhere('category_name', 'like', '%'.request('search').'%')
                ->orWhere('price', 'like', '%'.request('search').'%')
                ->orWhere('sim', 'like', '%'.request('search').'%')
                ->orWhere('storage', 'like', '%'.request('search').'%')
                ->orWhere('processor', 'like', '%'.request('search').'%')
                ->orWhere('size', 'like', '%'.request('search').'%')
                ->orWhere('memory', 'like', '%'.request('search').'%');
        })->paginate(5);
        return response()->json([
            'status' => 'success',
            'products' => $products,
        ]);
        // logger($products);
    }

    // working on setting discount price for product
    public function updateWithDiscountPrice (Request $request) {
        $data = [
            'price' => $request->discountPrice,
            'normal_price' => $request->normalPrice
        ];
        Product::where('id', $request->id)->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    // working on getting only discount products
    public function getDiscountProducts () {
        $discountProducts = Product::where('normal_price', '!=', null)->get();
        return response()->json([
            'discountProducts' => $discountProducts
        ]);
    }


    // working on getting same category products with count
    public function getSameCategoryProductsWithCount () {
        $sameCategoryProductsWithCount = DB::table('products')
                                            ->select('category_name', DB::raw('count(*) as total'))
                                            ->groupBy('category_name')
                                            ->get();
        return response()->json([
            'sameCategoryProductsWithCount' => $sameCategoryProductsWithCount
        ]);
    }

    // working on getting same category products on click
    public function getSameCategoryProductsOnClick (Request $request) {
        if ($request->categoryName == 'Devices') {
            $sameCategoryProductsOnClick = Product::get();
        } else {
            $sameCategoryProductsOnClick = Product::where('category_name', $request->categoryName)->get();
        }
        return response()->json([
            'sameCategoryProductsOnClick' => $sameCategoryProductsOnClick
        ]);
    }

    // working on getting products by sorting
    public function getProductsBySorting (Request $request) {
         if ($request->sortingValue == 'latest') {
            if ($request->categoryName == 'Devices') {
                $products = Product::orderBy('created_at', 'desc')->get();
            } else {
                $products = Product::where('category_name', $request->categoryName)->orderBy('created_at', 'desc')->get();
            }
        } else if ($request->sortingValue == 'lowToHigh') {
            if ($request->categoryName == 'Devices') {
                $products = Product::orderBy('price', 'asc')->get();
            } else {
                $products = Product::where('category_name', $request->categoryName)->orderBy('price', 'asc')->get();
            }
        } else if ($request->sortingValue == 'highToLow') {
            if ($request->categoryName == 'Devices') {
                $products = Product::orderBy('price', 'desc')->get();
            } else {
                $products = Product::where('category_name', $request->categoryName)->orderBy('price', 'desc')->get();
            }
        }
        return response()->json([
            'products' => $products
        ]);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminReply;
use App\Models\RatingImage;
use Illuminate\Support\Facades\Storage;

class RatingController extends Controller
{
    // create rating
    public function createRating (Request $request) {
            $data = [
                'user_id' => $request->userId,
                'product_id' => $request->productId,
                'rating' => $request->rating,
                'message' => $request->review,
                'review_title' => $request->reviewTitle,
                'rating_code' => $request->ratingCode,
            ];
            Rating::create($data);
            return response()->json([
                'status' => 'success'
            ]);
    }

    // get rating lists
    public function getRatings () {
        $ratings = Rating::select('ratings.*', 'users.name as user_name')
                    ->leftJoin('users', 'users.id', '=', 'ratings.user_id')
                    ->orderBy('created_at', 'desc')
                    ->get();
        $ratingImages = RatingImage::get();
        return response()->json([
            'ratings' => $ratings,
            'ratingImages' => $ratingImages
        ]);
    }

    // set images for rating
    public function setImages (Request $request) {
        $data = [
            'rating_code' => $request->ratingCode,
        ];
        if ($request->hasFile('image')) {
            $fileName = uniqid(). '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/image/ratingImg/', $fileName);
            $data['image'] = $fileName;
        }
        RatingImage::create($data);
        $ratingImages = RatingImage::where('rating_code', $request->ratingCode)->get();
        return response()->json([
            'ratingImages' => $ratingImages
        ]);
    }

    // delete selected images
    public function deleteSelectedImg (Request $request) {
        $oldImg = RatingImage::where('id', $request->imgId)->first();
        $oldImg = $oldImg->image;
        Storage::delete('public/image/ratingImg/'. $oldImg);
        RatingImage::where('id', $request->imgId)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    // delete on reload
    public function deleteOnReload (Request $request) {
        $oldImg = RatingImage::where('rating_code', $request->ratingCode)->first();
        $oldImg = $oldImg->image;
        Storage::delete('public/image/ratingImg/'. $oldImg);
        RatingImage::where('rating_code', $request->ratingCode)->delete();
    }

    // admin reply
    public function reply (Request $request) {
        $data = [
            'rating_code' => $request->ratingCode,
            'reply' => $request->reply
        ];
        AdminReply::create($data);

    }

    // get replied data
    public function getDatasForRating () {
        $adminReplies = AdminReply::get();
        $fiveStarsRating = Rating::where('rating', 5)->get();
        $fourStarsRating = Rating::where('rating', 4)->get();
        $threeStarsRating = Rating::where('rating', 3)->get();
        $twoStarsRating = Rating::where('rating', 2)->get();
        $oneStarsRating = Rating::where('rating', 1)->get();
        return response()->json([
            'adminReplies' => $adminReplies,
            'fiveStarsRating' => $fiveStarsRating,
            'fourStarsRating' => $fourStarsRating,
            'threeStarsRating' => $threeStarsRating,
            'twoStarsRating' => $twoStarsRating,
            'oneStarsRating' => $oneStarsRating
        ]);
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //getting users by option select
    public function getUsersListByOptionSelect (Request $request) {
        if ($request->value == 'all') {
            $users = User::get();
        } else if ($request->value == 'admins') {
            $users = User::where('role', 'admin')->get();
        } else if ($request->value == 'users') {
            $users = User::where('role', 'user')->get();
        }
        return response()->json([
            'users' => $users
        ]);
    }

    //delete users by its id
    public function deleteUser(Request $request) {
        $userId = $request->userId;
        $oldImage = User::where('id', $userId)->first();
        $oldImage = $oldImage->image;
        Storage::delete('public/image/' . $oldImage);
        User::where('id', $userId)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }

    // working on changing from admin to user
    public function changeRole (Request $request) {
        if ($request->role == 'user') {
            User::where('id', $request->id)->update([
                'role' => 'admin'
            ]);
        } else if ($request->role == 'admin') {
            User::where('id', $request->id)->update([
                'role' => 'user'
            ]);
        }
        return response()->json([
            'status' => 'success'
        ]);
    }

    // working on searching user data
    public function userSearch (Request $request) {
        $users = User::when($request->value, function ($query) {
            $query->orWhere('name', 'like', '%'.request('value').'%')
            ->orWhere('email', 'like', '%'.request('value').'%')
            ->orWhere('phone', 'like', '%'.request('value').'%')
            ->orWhere('address', 'like', '%'.request('value').'%')
            ->orWhere('gender', 'like', '%'.request('value').'%');
        })->get();
        return response()->json([
            'users' => $users
        ]);
    }

    // working on getting logged in user data for editing own profile
    public function getLoggedInUserData (Request $request) {
        $mainUser = User::where('id', $request->id)->first();
        return response()->json([
            'mainUser' => $mainUser
        ]);
    }


    // working on updating admin profile
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

    // working on getting users' emails
    public function getUsersEmails (Request $request) {
        $emails = User::select('email')->where('id', '!=', $request->id)->get();
        return response()->json([
            'emails' => $emails
        ]);
    }

}

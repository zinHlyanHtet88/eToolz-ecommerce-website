<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // direct to admin profile page
    public function index () {
        return view('admin.profile.index');
    }

    // direct edit profile page
    public function profileEditPage () {
        $user = User::where('id', Auth::user()->id)->first();
        return view('admin.profile.edit', compact('user'));
    }


    // direct to a page where you can change password
    public function changePasswordPage () {
        return view('admin.password.change');
    }

    // processing on changing admin password
    public function changePassword (Request $request) {
        $this->passwordValidationCheck($request);
        $oldPassword = $request->oldPassword;
        $dbPassword = User::where('id', Auth::user()->id)->first();
        $dbPassword = $dbPassword->password;
        if (Hash::check($oldPassword, $dbPassword)) {
            $newPassword = $request->newPassword;
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($newPassword)
            ]);
            return back()->with(['correctPassword' => 'Password changed successfully.']);
        } else {
            return back()->with(['incorrectPassword' => 'Old password does not match.']);
        }
    }

    // driect to admins list page
    public function adminsListPage () {
        return view('admin.list.index');
    }

    // working on deleteing other admins
    public function deleteAdmins ($id) {
        User::where('id', $id)->delete();
        return back();
    }




    // update Validation check
    private function updateValidationCheck ($request) {
        $validationRules = [
            'name' => 'min:4|required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'phone' => 'required|unique:users,phone,' . $request->id,
            'address' => 'required|min:4',
            'gender' => 'required',
            'image' => 'mimes:jpg,jpeg,png,webp'
        ];
        Validator::make($request->all(), $validationRules)->validate();

    }

    // insert updated data
    private function insertData ($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender
        ];
    }

    // password validation check
    private function passwordValidationCheck ($request) {
        $validationRules = [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:4|regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@]).*$/',
            'confirmPassword' => 'required|same:newPassword'
        ];

        $validationMessage = [
            'newPassword.regex' => 'Password must contain characters like " Aa@#$%15".'
        ];
        Validator::make($request->all(), $validationRules, $validationMessage)->validate();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // direct to notification page
    public function notiOrder () {
        return view('user.notification.order');
    }

    // direct to contact page
    public function contactPage () {
        return view('user.contact.index');
    }

    // direct to user home
    public function userHome () {
        return view('user.home.index');
    }

    // direct to noti message page
    public function messagePage () {
        return view('user.notification.message');
    }

    // direct to edit user profile page
    public function editProfilePage () {
        return view('user.profile.edit');
    }

    // direct to user password change page
    public function passwordChangePage () {
        return view('user.password.change');
    }

    // direct to service page
    public function servicePage () {
        return view('user.service.index');
    }

    // about us Page
    public function aboutUsPage () {
        return view('user.aboutUs.index');
    }
}

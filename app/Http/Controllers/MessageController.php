<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    // direct to admin message page
    public function list () {
        return view('admin.contact.index');
    }

    // direct to admin message reply page
    public function replyPage () {
        return view('admin.contact.reply');
    }
}

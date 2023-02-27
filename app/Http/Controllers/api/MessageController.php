<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\PrivateMessageReply;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // send message
    public function sendMessage (Request $request) {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'user_id' => $request->userId
        ];
        Message::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    // get message list
    public function list () {
        $messages = Message::get();
        return response()->json([
            'messages' => $messages
        ]);
    }

    // get message with its id
    public function getMessageWithId (Request $request) {
        $message = Message::where('id', $request->messageId)->first();
        return response()->json([
            'message' => $message
        ]);
    }

    // admin reply
    public function adminReply (Request $request) {
        $data = [
            'user_id' => $request->userId,
            'reply' => $request->adminReply
        ];
        PrivateMessageReply::create($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    // get admin replied private message
    public function getPrivateMessage (Request $request) {
        $privateMessages = PrivateMessageReply::where('user_id', $request->userId)->get();
        return response()->json([
            'privateMessages' => $privateMessages
        ]);
    }

    // delete Private Message
    public function deletePrivateMessage (Request $request) {
        PrivateMessageReply::where('id', $request->id)->delete();

    }
}

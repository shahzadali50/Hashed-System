<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    public function chatList()
    {
        return view('admin.chat.list');
    }
}

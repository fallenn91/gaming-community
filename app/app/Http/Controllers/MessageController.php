<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        return view('messages', [
            'recipient' => null,
        ]);
    }

    public function show(User $recipient)
    {
        return view('messages', [
            'recipient' => $recipient,
        ]);
    }
}

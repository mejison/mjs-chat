<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Dialog;
use App\User;
use App\Events\MessageSend;

class MessagesController extends Controller
{
    public function getAll(Dialog $dialog) {
        return response()->json([
            'data' => $dialog->messages
        ]);
    }

    public function send(Dialog $dialog, Request $request) {
        $me = auth()->user();

        $message = Message::create([
            'dialog_id' => $dialog->id,
            'sender_id' => $me->id,
            'recipient_id' => $request->recipient_id,
            'message' => $request->message,
        ]);

        $recipient = User::findOrFail($request->recipient_id);

        event(new MessageSend($recipient, $dialog));

        return response()->json([
            'data' => [],
            'message' => 'Successfuly send.'
        ]);
    }
}

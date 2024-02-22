<?php


namespace App\Http\Controllers\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Services\MessageService;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validate request data
        $request->validate([
            'message' => 'required|string',
        ]);

        // Fetch subscribers
        $subscribers = Subscriber::all();

        // Send message to each subscriber
        foreach ($subscribers as $subscriber) {
            MessageService::sendMessage($subscriber->phone_number, $request->message);
        }

        return response()->json(['message' => 'Messages sent successfully'], 200);
    }
}

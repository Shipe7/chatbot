<?php

namespace App\Http\Controllers\Api\V1\Controllers;




use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User; 
use App\Models\Channel;
use App\Models\Subscriber;
use BotMan\BotMan\BotMan;


class SubscribeController extends Controller
{
    /**
     * Handle incoming messages from BotMan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request)
    {
        $botman = app('botman');

        $botman->hears('subscribe', function (BotMan $bot) {
            $userId = $bot->getUser()->getId(); // Assuming you have user ID in your bot
            // Check if the user is already subscribed
            if (User::where('user_id', $userId)->exists()) {
                $bot->reply('You are already subscribed.');
            } else {
                // Subscribe the user
                $subscriber = new User();
                $subscriber->user_id = $userId;
                $subscriber->save();
                $bot->reply('You have been subscribed successfully.');
            }
        });

        $botman->fallback(function (BotMan $bot) {
            $bot->reply('Sorry, I did not understand that.');
        });

        // Handle incoming messages
        $botman->listen();
    }

    /**
     * Subscribe a user to the bot.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  


 
public function subscribe(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'password' => 'required|string',
        // You may adjust the validation rules as per your requirements
    ]);

    // Create a new subscriber with the validated data
    $subscriber = User::create($validatedData);

    return response('Subscriber created successfully', 201);

}
// public function test(){
//     echo("testing api");
// }

public function subscription(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'user_id' => 'required|integer'
    ]);

    // Create a new subscription record
    $subscription = Subscriber::create($validatedData);


    return response('Subscription created successfully', 201);


}



}

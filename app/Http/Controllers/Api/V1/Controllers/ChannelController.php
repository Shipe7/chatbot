<?php

namespace App\Http\Controllers\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User; 
use App\Models\Channel;

class ChannelController extends Controller
{
    //

    

public function subscribeToChannel(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|integer',
        'channelname' => 'required'
    ]);



$chan = Channel::create($validatedData);


return response('Channel Subscription created successfully', 201);


}
}

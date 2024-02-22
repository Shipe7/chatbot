<?php


namespace App\Http\Controllers\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber; // Assuming you have a Subscriber model

class SubscriptionController extends Controller
{

    /**
     * Subscribe user to chat bot
     *
     * @OA\Post(
     *     path="/api/v1/subscribe",
     *     summary="Subscribe user to chat bot",
     *     tags={"Subscription"},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             required={"user_id"},
     *             @OA\Property(property="user_id", type="string", example="80000000-8000-8000-8000-000000000008")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Subscription successful"),
     *     @OA\Response(response="409", description="User is already subscribed"),
     *     @OA\Response(response="422", description="Validation error")
     * )
     */

    public function subscribe(Request $request)
    {
        // Validate the incoming request data
        $this->validate($request, [
            'user_id' => 'required|uuid',
            // Add any additional validation rules as needed
        ]);

        // Check if the user is already subscribed
        if (Subscriber::where('user_id', $request->user_id)->exists()) {
            return response()->json(['message' => 'User is already subscribed.'], 409); // Conflict
        }

        // Create a new subscriber record
        $subscriber = new Subscriber();
        $subscriber->user_id = $request->user_id;
        // Add any additional data as needed
        $subscriber->save();

        return response()->json(['message' => 'Subscription successful'], 201); // Created
    }
}

<?php

namespace App\Http\Controllers\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function test(){
        return response()->json('data', 200);
    }
}

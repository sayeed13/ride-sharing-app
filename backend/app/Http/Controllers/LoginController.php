<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // validate a phone number
        $request->validate([
            'phone' => 'required|numeric|min:10'
        ]);

        // find or create a user
        $user = User::firstOrCreate([
            'phone' => $request->phone
        ]);

        if (!$user) {
            return response()->json(['message', 'Could not process a user with that phone number.']);
        }
        
        /*
        * https://laravel-notification-channels.com/
        */
        // send one time passcode to user
        

        // return response
    }
}

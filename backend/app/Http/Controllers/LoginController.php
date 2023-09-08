<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\LoginVerify;
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
            return response()->json(['message', 'Could not process a user with that phone number.'], 401);
        }
        
        /*
        * https://laravel-notification-channels.com/
        */
        // send one time passcode to user
        $user->notify(new LoginVerify());

        // return response
        return response()->json(["message" => "Login Code sent."]);
    }

    public function verify(Request $request)
    {
        //validate the incoming request
        $request->validate([
            'phone' => 'required|numeric|min:10',
            'login_code' => 'required|numeric|between:11111,99999'
        ]);

        //find the user & check login code is authentic or not
        $user = User::where('phone', $request->phone)
                    ->where('login_code', $request->login_code)
                    ->first();

        //if yes, send authentication code
        if ($user) {
            $user->update([
                'login_code' => null
            ]);
            return $user->createToken($request->login_code)->plainTextToken;
        };

        //otherwise return back with error message
        return response()->json(["message" => "Invalid Login Code."], 401);
    }
}

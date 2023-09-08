<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function show(Request $request)
    {
        //return user with associated driver model
        $user = $request->user();
        $user->load('driver');

        return $user;

    }

    public function update(Request $request)
    {
        $request->validate([
            'year' => 'required|numeric|between:2000,2023',
            'make' => 'required',
            'model' => 'required',
            'color' => 'required|alpha',
            'license_plate' => 'required',
            'name' => 'required'
        ]);

        $user = $request->user();

        $user->update($request->only('name'));

        //Create or update a driver associate with user

        $user->driver()->udateOrCreate($request->only([
            'year',
            'make',
            'model',
            'color',
            'license_plate',
        ]));

        $user->load('driver');

        return $user;

    }
}

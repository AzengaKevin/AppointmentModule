<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    /**
     * User Authentication
     * 
     * @param Request $request, current request instance
     */
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => ['bail', 'required', 'email'],
            'password' => ['bail', 'required', 'min:6']
        ]);

        if(Auth::attempt($data)){

            $accessToken = Auth::user()->createToken('elephant69')->accessToken;

            return response()->json([
                'data' => [
                    'user' => Auth::user(),
                    'access_token' => $accessToken
                ]
            ], 200);
        }

        return response()->json([
            'errors' => [
                'email' => ['Invalid Credentials']
            ]
        ], 401);
    }
}

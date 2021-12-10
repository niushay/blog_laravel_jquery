<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        //Validation
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        //Create User
        User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => bcrypt($request -> password),
        ]);

        //return response
        return response() -> json([
            'status' => 1,
            'message' => 'User has been created successfully'
        ]);

    }

    public function login(Request $request)
    {
        //Validation
        $login_data = $request -> validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        //Validate author data
        if(!auth() -> attempt($login_data)){
            return response() -> json([
                'status' =>  0,
                'message' => 'Invalid Credentials'
            ]);
        }

        //Token
        $token = auth() -> user() -> createToken("auth_token") -> accessToken;

        return response() -> json([
            'status' => 1,
            'message' => "User logged in successfully",
            'access_token' => $token
        ]);
    }

    public function login_page()
    {
        return view('users.login');
    }

    public function register_page()
    {
        return view('users.register');
    }


}

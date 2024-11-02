<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
{
    //validate user data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);
    //saving user data
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);
    //user saved successfuly
    return response()->json(['message' => 'User created successfully'], 201);
}

public function login(Request $request)
{
    //validate entered data
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    //making sure the user is registerd before logging in
    if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = Auth::user(); //get registered user's data
    $token = $user->createToken('task')->plainTextToken; //api token sanctum

    return response()->json(['token' => $token], 200);
}


}

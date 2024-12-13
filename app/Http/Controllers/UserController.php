<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MakeLoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(MakeLoginRequest $req)
    {

        $user = User::where("email", $req->email)->first();

        if (!$user) {
            return response()->json(["message" => "user not found"], 404);
        }

        if (!Hash::check($req->password, $user->password)) {
            return response()->json(["message" => "invalid credencials"], 400);
        }

        $token = $user->createToken("accessToken")->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token
        ], 200);
    }

    public function register(RegisterRequest $req)
    {

        $user = User::create([
            "name" =>  $req->name,
            "email" => $req->email,
            "password" => Hash::make($req->password)
        ]);

        $token = $user->createToken("accessToken")->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token
        ], 201);
    }
}

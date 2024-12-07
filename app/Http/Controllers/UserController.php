<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $req)
    {

        $userValidated = Validator::Make(request()->all(), [
            "email" => ["required", "email"],
            "password" => ["required", "confirmed"]
        ]);

        if ($userValidated->fails()) {
            return response()->json(["message" => $userValidated->errors()], 400);
        }

        $user = User::where("email", $req->email)->first();

        if (!$user) {
            return response()->json(["message" => "invalid credencials"], 400);
        }

        if (!Hash::check($req->password, $user->password)) {
            return response()->json(["message" => "invalid credencials"], 400);
        }


        $token = $user->createToken("accessToken")->plainTextToken;

        //abort_unless($user, 404);

        return response()->json([
            "user" => $user,
            "token" => $token
        ], 200);
    }

    public function register(Request $request)
    {

        $userValidated = Validator::make($request->all(), [
            "name" => ["string", "required"],
            "email" => ["required", "email", "unique:users"],
            "password" => ["required", "confirmed"]
        ]);

        if ($userValidated->fails()) {
            return response()->json(["message" => $userValidated->errors()], 400);
        }

        $user = User::create([
            "name" =>  $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        $token = $user->createToken("accessToken")->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token
        ], 201);
    }
}

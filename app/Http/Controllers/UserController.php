<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MakeLoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

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

        //$user->tokens()->delete();

        $tenMinutes = Carbon::now()->addMinutes(10);
        $sevenDays = Carbon::now()->addDays(7);
        $sevenDaysForCookie = 60 * 24 * 7;

        $refreshToken = $user->createToken("refreshToken", ["refresh"], $sevenDays)->plainTextToken;
        $token = $user->createToken("accessToken", ["token"], $tenMinutes)->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $token
        ], 200)->cookie("refreshToken", $refreshToken, $sevenDaysForCookie, "/", null, true, true);
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

    public function get(Request $req)
    {
        $users = User::all();

        return response()->json([
            "users" => $users
        ], 200);
    }

    public function logout(Request $req)
    {
        $req->user()->tokens()->delete();

        return response()->json("ok", 200)->cookie("refreshToken", "", -1);
    }

    public function verifyLogged(Request $req)
    {
        $userLogged = $req->cookie("refreshToken");
        if (!$userLogged) {
            return response()->json([false], 401);
        }
        return response()->json([true], 200);
    }

    public function refreshToken(Request $req)
    {
        $refreshToken = $req->cookie("refreshToken");
        if (!$refreshToken) {
            return response()->json(["message" => "Unauthorized"], 401);
        }

        $tokenModel = PersonalAccessToken::findToken($refreshToken);
        if (!$tokenModel) {
            return response()->json(["message" => "resource not found"], 404);
        }

        $user = $tokenModel->tokenable;
        if (!$user) {
            return response()->json(["message" => "resource not found"], 404);
        }

        // $user->tokens()->delete();

        $tenMinutes = Carbon::now()->addMinutes(10);
        $sevenDays = Carbon::now()->addDays(7);
        $sevenDaysForCookie = 60 * 24 * 7;

        $newRefreshToken = $user->createToken("refreshToken", ["refresh"], $sevenDays)->plainTextToken;
        $newToken = $user->createToken("accessToken", ["token"], $tenMinutes)->plainTextToken;

        return response()->json([
            "user" => $user,
            "token" => $newToken
        ], 200)->cookie("refreshToken", $newRefreshToken, $sevenDaysForCookie);
    }
}

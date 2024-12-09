<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function get(Request $req)
    {

        /** @var Notification $notification */
        $user_type = $req->input("user_type");
        if (!$user_type) {
            return response()->json(Notification::query()->where("user_type", "all")->get(), 200);
        } else {
            return response()->json(Notification::query()->where("user_type", "=", $user_type)->get(), 200);
        }

        return response()->json(["message" => "recources not found"], 404);
    }
}

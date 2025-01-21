<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function get(Request $req)
    {
        $q = $req->input("q");
        $notifications = Notification::query()->where("alias", "like", "%$q%")->orWhere("title", "like", "%$q%")->paginate(10);

        if (!$notifications) {
            return response()->json(["message" => "recources not found"], 404);
        }

        return response()->json([
            "notifications" => $notifications
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\NotificationUser;
use Illuminate\Http\Request;

class NotificationUserController extends Controller
{
    public function get()
    {
        $notificationsUsers =  NotificationUser::all();

        return response()->json([
            "notificationsUser" => $notificationsUsers
        ], 200);
    }
}

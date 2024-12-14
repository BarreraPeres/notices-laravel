<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoticeController extends Controller
{
    public function create(Request $req)
    {
        $NoticeValidated = Validator::make($req->all(), [
            "user_type" => ["required", "string"],
            "title" => ["required", "string"],
            "description" => ["required", "string"],
            "author" => ["required", "string"],
            "procedure" => ["required", "string"],
            "brief_description" => ["required", "string"],
            "generate_pop_up" => ["nullable", "boolean"],
            "pop_up_expiration" => ["nullable", "date"],
        ]);

        if ($NoticeValidated->fails()) {
            return response()->json(["message" => $NoticeValidated->errors()], 400);
        }

        $notice = Notice::create([
            "title" => $req->title,
            "description" => $req->description,
            "author" => $req->author,
            "procedure" => $req->procedure,
            "brief_description" => $req->brief_description,
            "generate_pop_up" => $req->generate_pop_up ?? false,
            "pop_up_expiration" => $req->pop_up_expiration ?? null,
        ]);

        $notification = Notification::create([
            "id_notice" => $notice->id,
            "alias" => $notice->title,
            "user_type" => $req->user_type,
        ]);

        $users = User::all();

        $notificationUser = $users->map(function (User $user) use ($notification) {
            return [
                "id_notification" => $notification->id,
                "id_user" => $user->id,
            ];
        });

        NotificationUser::insert($notificationUser->toArray());

        return response()->json([
            "notice" => $notice,
            "notification" => $notification
        ], 201);
    }

    public function get(Request $req)
    {
        $query = $req->query();
        //$notices = Notice::paginate(15);
        /** @var Notice $notice */
        $notices = Notice::query()
            ->whereLike("title",  $query, caseSensitive: false)
            ->orWhereLike("description", $query, caseSensitive: false)
            ->orWhereLike("author", $query, caseSensitive: false)
            ->get();


        return response()->json(
            $notices,
            200
        );
    }
}

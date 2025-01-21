<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticesAndNotificationsRequest;
use App\Models\Notice;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\User;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function create(StoreNoticesAndNotificationsRequest $req)
    {

        $notice = Notice::query()->create([
            "title" => $req->title,
            "description" => $req->description,
            "procedure" => $req->procedure,
            "brief_description" => $req->brief_description,
            "generate_pop_up" => $req->generate_pop_up,
            "pop_up_expiration" => $req->pop_up_expiration,
            "user_type" => $req->user_type,
            "author" => $req->user()->id
        ]);


        $notification = Notification::create([
            "id_notice" => $notice->id,
            "title" => $notice->title,
            "alias" => $notice->brief_description,
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
        $q = $req->input("q");

        /** @var Notice $notice */
        $notices = Notice::query()
            ->where("author", $req->user()->id)
            ->WhereLike("title",  "%$q%", caseSensitive: false)
            ->WhereLike("description", "%$q%", caseSensitive: false)
            ->paginate(15);

        if (!$notices) {
            return response()->json([
                "message" => "recources not found"
            ], 404);
        }
        return response()->json([
            "notices" => $notices
        ], 200);
    }
}

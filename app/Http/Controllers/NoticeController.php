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

        $notice = Notice::query()->create(
            $req->validated()
        );


        $notification = Notification::create([
            "id_notice" => $notice->id,
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
            ->whereLike("title",  "%$q%", caseSensitive: false)
            ->orWhereLike("description", "%$q%", caseSensitive: false)
            ->orWhereLike("author", "%$q%", caseSensitive: false)
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

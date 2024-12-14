<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationUser extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationUserFactory> */
    use HasFactory;

    protected $filable = [
        "id_notification",
        "id_user",
        "seen",
        "data_seen"
    ];

    public function notification(): BelongsTo
    {
        return $this->belongsTo(Notification::class, "id_notification");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "id_user");
    }
}

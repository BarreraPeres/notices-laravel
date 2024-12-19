<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Notification extends Model
{

    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;


    protected $guarded = [];

    protected $filable = [
        "id_notice",
        //        "user_type",
        "alias"
    ];

    public function notice(): BelongsTo
    {
        return $this->belongsTo(Notice::class, "id_notice");
    }

    public function notification(): HasOne
    {
        return $this->hasOne(NotificationUser::class, "id_notification");
    }

    public function user(): HasOne
    {
        return $this->hasOne(NotificationUser::class, "id_user");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{

    protected $guarded = [];
    public function notice(): BelongsTo
    {
        return $this->belongsTo(Notice::class, "id_notice");
    }
}

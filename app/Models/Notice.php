<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Notice extends Model
{
    /** @use HasFactory<\Database\Factories\NoticeFactory> */
    use HasFactory;


    protected $guarded = [];
    // protected $fillable = [
    //     'title',
    //     'procedure',
    //     'description',
    //     'brief_description',
    //     'author',
    //     'generate_pop_up',
    //     'pop_up_expiration',
    // ];


    public function notification(): HasOne
    {
        return $this->hasOne(Notification::class, "id_notice");
    }
}

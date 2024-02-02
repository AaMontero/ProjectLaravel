<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'start_datetime', 'end_datetime', 'status', 'comment', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

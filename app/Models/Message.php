<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'message', 'priority', 'type', 'status', 'start_date', 'end_date', 'user_id'];

    protected $appends = ['is_read'];

    public function getIsReadAttribute()
    {
        return $this->messagesViewed !== null;
    }

    public function messages_viewed()
    {
        return $this->hasOne(MessageViewed::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessagesModel extends Model
{
    use HasFactory;

    protected $table = 'request_chat_msgs';

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_user_id')->select('id', 'name', 'profile_img', 'email');
    }
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_user_id')->select('id', 'name', 'profile_img', 'email');
    }

    public function attachments()
    {
        return $this->hasMany(ChatAttachmentsModel::class, 'message_id', 'id');
    }
}

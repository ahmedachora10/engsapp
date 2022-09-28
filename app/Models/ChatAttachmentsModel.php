<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatAttachmentsModel extends Model
{
    use HasFactory;

    protected $table = 'request_chat_attachments';
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCommentsModel extends Model
{
    use HasFactory;

    protected $table = 'post_comments';
}

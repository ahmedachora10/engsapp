<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostsModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';

    public function comments()
    {
        return $this->hasMany(PostCommentsModel::class, 'post_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobsModel extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'recruiters_jobs';



    public function company()
    {
        return $this->belongsTo(User::class, 'user_id')->select('users.id', 'users.name', 'users.email', 'users.profile_img');
    }
}

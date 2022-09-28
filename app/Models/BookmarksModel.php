<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookmarksModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'bookmarks';

    public function request_data()
    {
        return $this->hasOne(ServiceRequests::class, 'id', 'request_id');
        // return $this->belongsTo(ServiceRequests::class, 'request_id');
    }
}

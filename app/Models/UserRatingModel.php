<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRatingModel extends Model
{
    use HasFactory;

    protected $table = 'user_rating';


    protected static function booted()
    {
        static::addGlobalScope('has_req', function (Builder $builder) {
            $builder->has('request')->has('rater')->has('rated');
        });
    }
    public function rater()
    {
        return $this->belongsTo(User::class, 'rater_user_id');
    }

    public function rated()
    {
        return $this->belongsTo(User::class, 'rated_user_id');
    }

    public function request()
    {
        return $this->belongsTo(ServiceRequests::class, 'request_id');
    }
}

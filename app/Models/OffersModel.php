<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Builder;

class OffersModel extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'offers';

    protected static function booted()
    {
        static::addGlobalScope('has_req', function (Builder $builder) {
            $builder->has('request');
        });
    }
    public function offer_attachments()
    {
        return $this->hasMany(OfferAttachmentModel::class, 'offer_id', 'id');
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function offer_status()
    {
        $columnName = App::currentLocale() == 'ar' ? 'name_ar as name' : 'name_en as name';
        return $this->belongsTo(OfferStatusModel::class, 'offer_status_id')->select('id', $columnName);;
    }

    public function request()
    {
        return $this->belongsTo(ServiceRequests::class, 'request_id');
    }
}

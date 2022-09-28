<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ServiceRequests extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'requests';

    protected $casts = [
        'deadline_date' => 'date',
        'xPoint' => 'float',
        'yPoint' => 'float',
    ];

    protected static function booted()
    {
        static::retrieved(function ($service_request) {
            // check request stage based on dates
            // {{dd(Carbon::today());}}


            //TODO : DELETE IF STATEMENT
            //ERROR FROM DB NEED TO DELETE TEMP DATA
            // if ($service_request->deadline_data != null) {
            //ERROR FROM DB NEED TO DELETE TEMP DATA
            if (
                $service_request->service_request_stage_id == Config::get('constants.request_stages.waiting_offers')
                &&
                $service_request->deadline_date->lt(Carbon::today())
            ) {
                // dd($service_request->deadline_date);
                $service_request->service_request_stage_id = Config::get('constants.request_stages.accepting_offers');
                $service_request->save();
                // $service_request->refresh();
            }
            // }
        });
    }



    public function service()
    {
        return $this->belongsTo(ServicesModel::class, 'service_id')->withDefault();
    }

    public function service_stage()
    {
        $columnName = App::currentLocale() == 'ar' ? 'name_ar as name' : 'name_en as name';
        return $this->belongsTo(ServiceStagesModel::class, 'service_request_stage_id')->select('service_request_stages.id', $columnName)->withDefault(['id'=>0,'name'=>'قيد المراجعة']);;
    }

    public function requested_services_per_project()
    {
        return $this->hasMany(requestServices::class, 'request_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(requestAttachments::class, 'request_id', 'id');
    }

    public function requested_services()
    {
        $columnName = App::currentLocale() == 'ar' ? 'service_name_ar as name' : 'service_name_en as name';
        return $this->belongsToMany(serviceCategories::class, 'request_services', 'request_id', 'service_category_id')->select('service_categories.id', $columnName);
    }

    public function offers()
    {
        return $this->hasMany(OffersModel::class, 'request_id', 'id');
    }

    public function accpeted_offer()
    {
        return $this->hasMany(OffersModel::class, 'request_id', 'id')
            ->with('operator')
            // ->where('offer_status_id', 2)
            ->whereIn('offer_status_id', [2, 4])
            ->first();
    }

    public function visit_report()
    {
        return $this->hasOne(VisitReport::class, 'request_id', 'id');
    }

    public function service_request_owner()
    {
        return $this->belongsTo(User::class, 'user_id');;
    }

    public function operator_offer()
    {
        return $this->hasOne(OffersModel::class, 'request_id', 'id')->whereIn('offer_status_id', [2, 4]);
    }

    public function currentUser_offer()
    {
        return $this->hasOne(OffersModel::class, 'request_id', 'id')->where('user_id', Auth::user()->id);
    }

    public function bookmarkStatus($request_id)
    {
        return DB::table('bookmarks')
            ->where('user_id', Auth::user()->id)
            ->where('request_id', $request_id)
            ->whereNull('deleted_at')
            ->first();
    }
}

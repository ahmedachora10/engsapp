<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class UserServices extends Model
{
    use HasFactory;

    protected $table = 'user_services';

    public $timestamps = false;


    public function service_category()
    {
        $columnName = App::currentLocale() == 'ar' ? 'service_name_ar as name' : 'service_name_en as name';
        return $this->belongsTo(serviceCategories::class, 'service_category_id', 'id')->select('service_categories.id', $columnName,'parent');;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

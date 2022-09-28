<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class serviceCategories extends Model
{
    use HasFactory;


    protected $table = 'service_categories';


    public function getServicesCategroiesByTypeId($service_type_id)
    {
        $columnName = App::currentLocale() == 'ar' ? 'service_name_ar as name' : 'service_name_en as name';
        $columnName2 = App::currentLocale() == 'ar' ? 'service_decription_ar as decription' : 'service_decription_en as decription';
        $result = serviceCategories::select('id', $columnName,$columnName2)->where('service_type_id', $service_type_id)->orderBy($service_type_id==4?'service_decription_en':'id')->get();
        return $result;
    }

    public function getServicesCategroiesByTypeIdAndParent($service_type_id, $parent_id)
    {
        $columnName = App::currentLocale() == 'ar' ? 'service_name_ar as name' : 'service_name_en as name';
        $result = serviceCategories::select('id', $columnName,'service_decription_ar as decription', 'parent')->where(['service_type_id' => $service_type_id, 'parent' => $parent_id])->get();
        return $result;
    }

    public function getAllServiceCategories()
    {
        $columnName = App::currentLocale() == 'ar' ? 'service_name_ar as name' : 'service_name_en as name';
        $result = serviceCategories::select('id', 'service_type_id', $columnName, 'parent')->get();
        return $result;
    }

    public function parent_service()
    {
        $columnName = App::currentLocale() == 'ar' ? 'service_name_ar as name' : 'service_name_en as name';

        return $this->belongsTo(self::class,'parent')->select('service_categories.id', $columnName,'parent');
    }
}

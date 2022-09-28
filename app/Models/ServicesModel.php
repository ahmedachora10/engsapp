<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ServicesModel extends Model
{
    use HasFactory;

    protected $table = 'services';

    public function getServices()
    {
        $columnName = App::currentLocale() == 'ar' ? 'name_ar as name' : 'name_en as name';
        $result = ServicesModel::select('id', $columnName)->get();
        return $result;
    }
    public function getFreeLancerServices()
    {
        $columnName = App::currentLocale() == 'ar' ? 'name_ar as name' : 'name_en as name';
        $result = ServicesModel::select('id', $columnName)->whereNotIn('id',[2,5])->get();
        return $result;
    }
}

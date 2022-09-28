<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';



    public function getCountries()
    {
        $columnName = App::currentLocale() == 'ar' ? 'name as name' : 'name_en as name';
        $result = Country::select('id', $columnName)->get();
        return $result;
    }
}

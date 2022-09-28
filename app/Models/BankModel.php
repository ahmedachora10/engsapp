<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class BankModel extends Model
{
    use HasFactory;

    protected $table = 'banks';


    public function getBanks()
    {
        $columnName = App::currentLocale() == 'ar' ? 'name_ar as name' : 'name_en as name';
        $result = BankModel::select('id', $columnName)->get();
        return $result;
    }
}

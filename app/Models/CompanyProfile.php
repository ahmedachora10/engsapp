<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $table = 'company_profile';

    protected $casts = [
        'arbitrationcert_request_status' => 'boolean',
        'arbitrationcert_confirmed' => 'boolean',
        
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerProfile extends Model
{
    use HasFactory;

    protected $table = 'freelancer_profile';

    public function getOccupationTextAttribute()
    {
        switch ($this->occupation){
            case 'civil':return 'مهندس مدني';
            case 'architect':return 'مهندس معماري';
            case 'space':return 'مهندس مساحي';
            case 'electrical':return 'مهندس كهربائي';
            case 'mechanical':return 'مهندس ميكانيكي';
            case 'industrial':return 'مهندس صناعي';
            case 'planning':return 'مهندس  تخطيط';
            default:return 'مهندس';
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferStatusModel extends Model
{
    use HasFactory;

    protected $table = 'offer_status';

    public $timestamps = false;

}

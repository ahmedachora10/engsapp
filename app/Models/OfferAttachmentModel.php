<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferAttachmentModel extends Model
{
    use HasFactory;

    protected $table = 'offer_attachments';
    public $timestamps = false;
    protected $fillable = ['offer_id', 'filename', 'hashName'];
}

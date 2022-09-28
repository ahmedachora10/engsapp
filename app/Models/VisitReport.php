<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitReport extends Model
{
    use HasFactory;

    protected $table = 'visit_report';


    public function attachments()
    {
        return $this->hasMany(VisitReportAttachments::class, 'visit_report_id');
    }
}

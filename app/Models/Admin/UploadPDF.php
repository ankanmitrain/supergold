<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class UploadPDF extends Model
{

    protected $table = 'UploadPDF';
    protected $fillable = [
        'title',
        'pdf_path',
        'publish_date',
        'publish_time',
        'enable_pdf',
    ];

    protected $casts = [
        'publish_date' => 'datetime:H:i:s',
    ];

}

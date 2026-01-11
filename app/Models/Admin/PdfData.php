<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class PdfData extends Model
{

    protected $table = 'PdfData';
    protected $fillable = ['data'];

    protected $casts = [
         'data' => 'array',   // auto convert JSON to array
    ];

}

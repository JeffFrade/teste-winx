<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BatchInfo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_batch',
        'line',
        'line_content',
        'status',
        'obs'
    ];
}

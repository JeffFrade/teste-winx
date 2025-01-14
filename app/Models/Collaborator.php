<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collaborator extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_company',
        'name',
        'email',
        'position',
        'admission_date',
        'active'
    ];
}

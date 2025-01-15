<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_company',
        'id_user',
        'status'
    ];

    public function company()
    {
        return $this->hasOne(Batch::class, 'id', 'id_company');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}

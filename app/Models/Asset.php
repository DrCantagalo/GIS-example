<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = ['name','category','latitude','longitude','properties'];
    protected $casts = [
        'properties' => 'array',
    ];
}

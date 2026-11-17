<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $primaryKey='qualification_id';
    protected $fillable = [
        'qualification_name',
    ];
}

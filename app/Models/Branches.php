<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    protected $primaryKey='branch_id';
protected $fillable = [
        'qualification_id',
        'branch_name',
    ];

    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id', 'qualification_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription_plans extends Model
{
    protected $table = 'subscription_plans';

    protected $fillable = [
        'plan_name',
        'price',
        'duration_days',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
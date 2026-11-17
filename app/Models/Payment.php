<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subscription_plans;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
        'payment_method',
        'payment_status',
        'paid_at',
    ];

    protected $casts = [
        'amount'  => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'userid');
    }

    public function plan()
    {
        return $this->belongsTo(Subscription_plans::class, 'plan_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Subscription_plans;

class Subscription extends Model
{
    protected $table = 'subscriptions';

    protected $fillable = [
        'user_id',
        'plan_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'userid');
    }

    public function plan()
    {
        return $this->belongsTo(Subscription_plans::class, 'plan_id', 'id');
    }

    /**
     * Check if the subscription is currently active
     */
    public function isCurrentlyActive(): bool
    {
        return $this->status === 'active' && $this->end_date && Carbon::now()->lte($this->end_date);
    }

    /**
     * Calculate remaining days
     */
    public function getDaysRemainingAttribute(): int
    {
        if (!$this->end_date || Carbon::now()->gt($this->end_date)) {
            return 0;
        }
        return (int) Carbon::now()->diffInDays($this->end_date, false);
    }
}

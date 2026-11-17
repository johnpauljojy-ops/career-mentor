<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'userid';

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
        'status',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id', 'userid');
    }

    public function activeSubscription()
    {
        return $this->hasOne(Subscription::class, 'user_id', 'userid')
            ->where('status', 'active')
            ->where('end_date', '>=', now())
            ->latest('id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'userid');
    }

    public function resumes()
    {
        return $this->hasMany(Resume::class, 'user_id', 'userid');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'userid', 'userid');
    }

}
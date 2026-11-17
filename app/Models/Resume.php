<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resumes';

    protected $fillable = [
        'user_id',
        'template_id',
        'full_name',
        'email',
        'phone',
        'location',
        'title',
        'objective',
        'education',
        'experience',
        'skills',
        'achievements',
        'language',
        'hobbies',
        'ai_job_description',
        'ai_score',
        'ai_deficiency',
        'ai_suggestions',
    ];

    protected $casts = [
        'ai_score' => 'integer',
        'ai_deficiency' => 'integer',
        'ai_suggestions' => 'array',
    ];

    /**
     * User relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'userid');
    }

    /**
     * Resume Template relationship
     */
    public function template()
    {
        return $this->belongsTo(ResumeTemplate::class, 'template_id', 'id');
    }

    /**
     * Student relationship via user_id
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'user_id', 'userid');
    }

    /**
     * Check if this resume belongs to Normal template
     */
    public function isNormal(): bool
    {
        return $this->template ? $this->template->isNormal() : false;
    }

    /**
     * Check if this resume belongs to Standard template
     */
    public function isStandard(): bool
    {
        return $this->template ? $this->template->isStandard() : false;
    }

    /**
     * Check if this resume belongs to Premium template
     */
    public function isPremium(): bool
    {
        return $this->template ? $this->template->isPremium() : false;
    }
}

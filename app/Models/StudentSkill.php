<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentSkill extends Model
{
    protected $table = 'student_skills';
    protected $primaryKey = 'skill_id';

    protected $fillable = [
        'studentid',
        'skill_name',
    ];

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'studentid',
            'studentid'
        );
    }
}
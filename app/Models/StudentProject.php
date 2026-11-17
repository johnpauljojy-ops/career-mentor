<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProject extends Model
{
    protected $table = 'student_projects';
    protected $primaryKey = 'project_id';

    protected $fillable = [
        'studentid',
        'project_title',
        'description',
        'technologies',
        'project_url',
        'start_date',
        'end_date',
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
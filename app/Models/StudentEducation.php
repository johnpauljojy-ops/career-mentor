<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEducation extends Model
{
    protected $table = 'student_educations';

    protected $primaryKey = 'education_id';

    protected $fillable = [
        'studentid',
        'qualification_name',
        'branch_name',
        'institution_name',
        'start_year',
        'end_year',
        'cgpa',
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
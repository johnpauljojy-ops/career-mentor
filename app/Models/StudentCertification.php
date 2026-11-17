<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCertification extends Model
{
    protected $table = 'student_certifications';
    protected $primaryKey = 'certification_id';

    protected $fillable = [
        'studentid',
        'certification_name',
        'issuing_organization',
        'issue_date',
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
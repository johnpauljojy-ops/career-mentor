<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentLanguage extends Model
{
    protected $table = 'student_languages';
    protected $primaryKey = 'language_id';

    protected $fillable = [
        'studentid',
        'language_name',
        'proficiency',
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
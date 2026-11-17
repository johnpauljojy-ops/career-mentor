<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Qualification;
// Use Branches or Branch based on your actual file name in app/Models/
use App\Models\Branches; 
use App\Models\StudentSkill;
use App\Models\StudentProject;
use App\Models\StudentCertification;
use App\Models\StudentLanguage;
use App\Models\StudentEducation;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'studentid';

    protected $fillable = [
        'userid',
        'phone',
        'gender',
        'dob',
        'qualification_id',
        'branch_id',
        'collegename',
        'cgpa',
        'graduation_year',
        'interest',
        'carrergoal',
        'photo',
    ];

    /*
    |--------------------------------------------------------------------------
    | User Relationship
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        // Dynamically uses User's primary key (works whether users PK is 'id' or 'userid')
        $userInstance = new User();
        return $this->belongsTo(
            User::class,
            'userid',
            $userInstance->getKeyName()
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Qualification Relationship
    |--------------------------------------------------------------------------
    */
    public function qualification()
    {
        return $this->belongsTo(
            Qualification::class,
            'qualification_id',
            'qualification_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Branch Relationship
    |--------------------------------------------------------------------------
    */
    public function branch()
    {
        return $this->belongsTo(
            Branches::class,
            'branch_id',
            'branch_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Skills
    |--------------------------------------------------------------------------
    */
    public function skills()
    {
        return $this->hasMany(
            StudentSkill::class,
            'studentid',
            'studentid'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Projects
    |--------------------------------------------------------------------------
    */
    public function projects()
    {
        return $this->hasMany(
            StudentProject::class,
            'studentid',
            'studentid'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Certifications
    |--------------------------------------------------------------------------
    */
    public function certifications()
    {
        return $this->hasMany(
            StudentCertification::class,
            'studentid',
            'studentid'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Languages
    |--------------------------------------------------------------------------
    */
    public function languages()
    {
        return $this->hasMany(
            StudentLanguage::class,
            'studentid',
            'studentid'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Education History
    |--------------------------------------------------------------------------
    */
    public function educations()
    {
        return $this->hasMany(
            StudentEducation::class,
            'studentid',
            'studentid'
        );
    }
}
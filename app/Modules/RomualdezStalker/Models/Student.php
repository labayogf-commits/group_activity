<?php

namespace App\Modules\RomualdezStalker\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Explicitly define your database table name if it does not follow Laravel's plural naming convention
    protected $table = 'students'; 

    // Specify the fields that are allowed to be filled dynamically
    protected $fillable = [
        'student_id',
        'name',
        'course',
        'year',
        'email'
    ];
}

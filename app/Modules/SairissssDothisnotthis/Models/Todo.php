<?php

namespace App\Modules\SairissssDothisnotthis\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'category',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];
}
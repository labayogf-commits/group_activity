<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    protected $table = 'job_posts';

    protected $fillable = [
        'title',
        'company_name',
        'location',
        'description',
        'job_type',
        'salary',
        'apply_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
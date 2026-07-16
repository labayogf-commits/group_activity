<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    protected $fillable = [
        'title',
        'company_name',
        'location',
        'description',
        'job_type',
        'salary',
        'apply_link'
    ];

    /**
     * Get the user that owns the job post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
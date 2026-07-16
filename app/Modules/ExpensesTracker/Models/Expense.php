<?php

namespace App\Modules\ExpensesTracker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Expense extends Model
{
    protected $fillable = [
        'item_name',
        'amount',
        'category',
        'date',
        'user_id', 
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
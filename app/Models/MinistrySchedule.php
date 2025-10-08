<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MinistrySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'ministry_id',
        'schedule_date',
        'start_time',
        'end_time',
        'location',
        'description',
        'status', // scheduled, completed, cancelled
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'schedule_date' => 'date',
    ];

    // Relationships
    public function ministry(): BelongsTo
    {
        return $this->belongsTo(Ministry::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Scopes
    public function scopeUpcoming($query)
    {
        return $query->where('schedule_date', '>=', now()->toDateString());
    }

    public function scopeByMinistry($query, $ministryId)
    {
        return $query->where('ministry_id', $ministryId);
    }
}

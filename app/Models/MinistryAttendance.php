<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MinistryAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'ministry_id',
        'member_id',
        'schedule_id',
        'attendance_date',
        'status', // hadir, tidak hadir, terlambat
        'notes',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'attendance_date' => 'datetime',
    ];

    // Relationships
    public function ministry(): BelongsTo
    {
        return $this->belongsTo(Ministry::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(MinistrySchedule::class, 'schedule_id');
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
    public function scopePresent($query)
    {
        return $query->where('status', 'hadir');
    }

    public function scopeAbsent($query)
    {
        return $query->where('status', 'tidak hadir');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ministry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'status', // aktif, tidak aktif
        'leader_id',
        'created_by',
        'updated_by'
    ];

    // Relationships
    public function leader(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'leader_id');
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_ministries');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(MinistrySchedule::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(MinistryAttendance::class);
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
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}

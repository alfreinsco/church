<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'family_name',
        'head_of_family_id',
        'address',
        'phone',
        'notes',
        'created_by',
        'updated_by'
    ];

    // Relationships
    public function headOfFamily(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'head_of_family_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Accessors
    public function getTotalMembersAttribute()
    {
        return $this->members()->count();
    }
}

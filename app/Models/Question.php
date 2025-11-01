<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'status', // open, closed
        'views_count'
    ];

    protected $casts = [
        'views_count' => 'integer',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    // Get the best answer if one has been marked
    public function bestAnswer()
    {
        return $this->hasOne(Answer::class)->where('is_best_answer', true);
    }

    // Helper methods
    public function isSolved(): bool
    {
        return $this->status === 'closed' || $this->bestAnswer()->exists();
    }

    public function incrementViewCount(): void
    {
        $this->increment('views_count');
    }
}
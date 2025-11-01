<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'question_id',
        'is_best_answer'
    ];

    protected $casts = [
        'is_best_answer' => 'boolean',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    // Methods
    public function markAsBestAnswer(): void
    {
        // First unmark any existing best answer for this question
        $this->question->answers()->update(['is_best_answer' => false]);
        
        // Mark this answer as best
        $this->update(['is_best_answer' => true]);
        
        // Close the question
        $this->question->update(['status' => 'closed']);
    }
}
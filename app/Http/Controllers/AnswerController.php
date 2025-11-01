<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Store a newly created answer.
     */
    public function store(Request $request, Question $question)
    {
        $validated = $request->validate([
            'content' => 'required|min:20',
        ]);

        $question->answers()->create([
            'content' => $validated['content'],
            'user_id' => $request->user()->id,
        ]);

        return back()->with('status', 'Jawaban anda telah diposting!');
    }

    /**
     * Mark an answer as the best answer.
     */
    public function markAsBest(Answer $answer)
    {
        // Check if the authenticated user is the question owner
        if ($answer->question->user_id !== auth()->id()) {
            abort(403);
        }

        $answer->markAsBestAnswer();

        return back()->with('status', 'Jawaban telah dipilih sebagai jawaban terbaik!');
    }

    /**
     * Delete an answer.
     */
    public function destroy(Answer $answer)
    {
        // Check if the authenticated user owns this answer
        if ($answer->user_id !== auth()->id()) {
            abort(403);
        }

        $answer->delete();

        return back()->with('status', 'Jawaban telah dihapus.');
    }
}
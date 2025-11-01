<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuestionController extends Controller
{
    /**
     * Display a listing of the questions.
     */
    public function index(Request $request): View
    {
        $query = Question::with(['user', 'answers'])
            ->latest();

        // Apply search filter if provided
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Apply status filter if provided
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $questions = $query->paginate(12);

        return view('forum.index', [
            'questions' => $questions,
            'query' => $search
        ]);
    }

    /**
     * Show the form for creating a new question.
     */
    public function create(): View
    {
        return view('forum.create');
    }

    /**
     * Store a newly created question.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:10|max:255',
            'content' => 'required|min:20',
        ]);

        $question = $request->user()->questions()->create($validated);

        return redirect()->route('forum.show', $question)
            ->with('status', 'Pertanyaan berhasil dibuat!');
    }

    /**
     * Display the specified question.
     */
    public function show(Question $question): View
    {
        // Increment the view count
        $question->incrementViewCount();

        return view('forum.show', [
            'question' => $question->load(['user', 'answers.user'])
        ]);
    }
}
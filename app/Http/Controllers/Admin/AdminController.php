<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plant;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_plants' => Plant::count(),
            'total_questions' => Question::count(),
            'total_answers' => Answer::count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_questions' => Question::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::withCount(['plants', 'questions', 'answers'])
            ->latest()
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'location' => 'required|string|max:255',
        ]);

        $user->update($validated);
        return redirect()->route('admin.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroyUser(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }

    public function toggleAdmin(User $user)
    {
        if ($user->id !== Auth::id()) {
            $user->is_admin = !$user->is_admin;
            $user->save();
            return back()->with('success', 'Status admin berhasil diperbarui.');
        }
        return back()->with('error', 'Anda tidak dapat mengubah status admin Anda sendiri.');
    }

    public function forum()
    {
        $questions = Question::with(['user', 'answers', 'answers.user'])
            ->latest()
            ->paginate(15);

        return view('admin.forum.index', compact('questions'));
    }

    public function createQuestion()
    {
        return view('admin.forum.questions.create');
    }

    public function storeQuestion(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $question = Question::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('admin.forum.index')
            ->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function editQuestion(Question $question)
    {
        return view('admin.forum.questions.edit', compact('question'));
    }

    public function updateQuestion(Request $request, Question $question)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $question->update($validated);

        return redirect()->route('admin.forum.index')
            ->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function deleteQuestion(Question $question)
    {
        $question->delete();
        return back()->with('success', 'Pertanyaan berhasil dihapus.');
    }

    public function deleteAnswer(Answer $answer)
    {
        $answer->delete();
        return back()->with('success', 'Jawaban berhasil dihapus.');
    }
}
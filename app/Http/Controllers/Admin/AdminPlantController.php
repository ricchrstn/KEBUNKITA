<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use App\Models\User;
use Illuminate\Http\Request;

class AdminPlantController extends Controller
{
    public function index()
    {
        $plants = Plant::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.plants.index', compact('plants'));
    }

    public function byUser(User $user)
    {
        $plants = Plant::where('user_id', $user->id)
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('admin.plants.by-user', compact('plants', 'user'));
    }

    public function delete(Plant $plant)
    {
        $plant->delete();
        return back()->with('success', 'Tanaman berhasil dihapus.');
    }
}
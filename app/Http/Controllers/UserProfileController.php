<?php

namespace App\Http\Controllers;

use App\Models\UserProgress;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $badges = $user->badges()->get();
        $completedCount = UserProgress::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
        $totalProgress = UserProgress::where('user_id', $user->id)->get();

        return Inertia::render('UserProfile', [
            'userProfile' => [
                'name' => $user->name,
                'email' => $user->email,
                'joined' => $user->created_at->format('M Y'),
                'completedTutorials' => $completedCount,
                'totalActivities' => $totalProgress->count(),
            ],
            'badges' => $badges,
        ]);
    }
}

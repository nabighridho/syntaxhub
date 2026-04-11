<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Bookmark;
use App\Models\Snippet;
use App\Models\Tutorial;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $totalTutorials = Tutorial::count();
        $completedTutorials = UserProgress::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();
        $inProgressTutorials = UserProgress::where('user_id', $user->id)
            ->where('status', 'in_progress')
            ->count();
        $totalBookmarks = Bookmark::where('user_id', $user->id)->count();
        $totalBadges = $user->badges()->count();
        $totalSnippets = Snippet::count();

        $recentProgress = UserProgress::where('user_id', $user->id)
            ->with('tutorial')
            ->latest()
            ->take(5)
            ->get();

        $earnedBadges = $user->badges()->latest('user_badges.created_at')->take(4)->get();

        return Inertia::render('Dashboard', [
            'stats' => [
                'totalTutorials' => $totalTutorials,
                'completedTutorials' => $completedTutorials,
                'inProgressTutorials' => $inProgressTutorials,
                'totalBookmarks' => $totalBookmarks,
                'totalBadges' => $totalBadges,
                'totalSnippets' => $totalSnippets,
                'progressPercent' => $totalTutorials > 0
                    ? round(($completedTutorials / $totalTutorials) * 100)
                    : 0,
            ],
            'recentProgress' => $recentProgress,
            'earnedBadges' => $earnedBadges,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\UserProgress;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $progress = UserProgress::where('user_id', $user->id)
            ->with('tutorial')
            ->get();

        $badges = $user->badges()->get();

        $weeklyData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = UserProgress::where('user_id', $user->id)
                ->whereDate('updated_at', $date->toDateString())
                ->count();
            $weeklyData[] = [
                'day' => $date->format('D'),
                'date' => $date->format('M d'),
                'activities' => $count,
            ];
        }

        return Inertia::render('Progress', [
            'progress' => $progress,
            'badges' => $badges,
            'weeklyData' => $weeklyData,
            'stats' => [
                'completed' => $progress->where('status', 'completed')->count(),
                'inProgress' => $progress->where('status', 'in_progress')->count(),
                'total' => \App\Models\Tutorial::count(),
                'totalTime' => $progress->where('status', 'completed')
                    ->sum(fn($p) => $p->tutorial->estimated_minutes ?? 0),
            ],
        ]);
    }
}

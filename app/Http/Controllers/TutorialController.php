<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use App\Models\UserProgress;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TutorialController extends Controller
{
    public function index(Request $request)
    {
        $tutorials = Tutorial::orderBy('order')->get();
        $userProgress = [];

        if ($request->user()) {
            $userProgress = UserProgress::where('user_id', $request->user()->id)
                ->pluck('status', 'tutorial_id')
                ->toArray();
        }

        return Inertia::render('Tutorials/Index', [
            'tutorials' => $tutorials,
            'userProgress' => $userProgress,
        ]);
    }

    public function show(Request $request, Tutorial $tutorial)
    {
        $progress = null;
        if ($request->user()) {
            $progress = UserProgress::where('user_id', $request->user()->id)
                ->where('tutorial_id', $tutorial->id)
                ->first();
        }

        $prevTutorial = Tutorial::where('order', '<', $tutorial->order)->orderByDesc('order')->first();
        $nextTutorial = Tutorial::where('order', '>', $tutorial->order)->orderBy('order')->first();

        return Inertia::render('Tutorials/Show', [
            'tutorial' => $tutorial,
            'progress' => $progress,
            'prevTutorial' => $prevTutorial,
            'nextTutorial' => $nextTutorial,
        ]);
    }

    public function updateProgress(Request $request, Tutorial $tutorial)
    {
        $request->validate(['status' => 'required|in:not_started,in_progress,completed']);

        $progress = UserProgress::updateOrCreate(
            ['user_id' => $request->user()->id, 'tutorial_id' => $tutorial->id],
            [
                'status' => $request->status,
                'completed_at' => $request->status === 'completed' ? now() : null,
            ]
        );

        return back()->with('message', 'Progress updated!');
    }
}

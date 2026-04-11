<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Snippet;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {
        $bookmarks = Bookmark::where('user_id', $request->user()->id)
            ->with('bookmarkable')
            ->latest()
            ->get()
            ->map(function ($bookmark) {
                return [
                    'id' => $bookmark->id,
                    'type' => class_basename($bookmark->bookmarkable_type),
                    'item' => $bookmark->bookmarkable,
                    'created_at' => $bookmark->created_at,
                ];
            });

        return Inertia::render('Bookmarks', [
            'bookmarks' => $bookmarks,
        ]);
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'bookmarkable_type' => 'required|in:tutorial,snippet',
            'bookmarkable_id' => 'required|integer',
        ]);

        $type = $request->bookmarkable_type === 'tutorial' ? Tutorial::class : Snippet::class;

        $existing = Bookmark::where('user_id', $request->user()->id)
            ->where('bookmarkable_type', $type)
            ->where('bookmarkable_id', $request->bookmarkable_id)
            ->first();

        if ($existing) {
            $existing->delete();
            return back()->with('message', 'Bookmark removed!');
        }

        Bookmark::create([
            'user_id' => $request->user()->id,
            'bookmarkable_type' => $type,
            'bookmarkable_id' => $request->bookmarkable_id,
        ]);

        return back()->with('message', 'Bookmark added!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MySuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suggestions = \App\Models\Suggestion::with('sender')
            ->where('recipient_id', \Illuminate\Support\Facades\Auth::id())
            ->latest()
            ->paginate(10);

        return view('my_suggestions.index', compact('suggestions'));
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Suggestion $suggestion)
    {
        // Security check
        if ($suggestion->recipient_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        // Mark as read
        if (!$suggestion->is_read) {
            $suggestion->update(['is_read' => true]);

            // Also mark notification as read IF we link them, but simpler is to mark all notifications 
            // related to this suggestion ID as read.
            // Or just leave notification management to the user (mark all read button).
            // Let's be smart: find notification with this data.
            $notification = \Illuminate\Support\Facades\Auth::user()
                ->notifications()
                ->where('data->suggestion_id', $suggestion->id)
                ->first();

            if ($notification) {
                $notification->markAsRead();
            }
        }

        return view('my_suggestions.show', compact('suggestion'));
    }
}

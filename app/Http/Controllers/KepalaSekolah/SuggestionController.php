<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Suggestion::with(['sender', 'recipient'])
            ->where('sender_id', \Illuminate\Support\Facades\Auth::id())
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            });
        }

        if ($request->filled('recipient_role')) {
            $query->where('recipient_role', $request->recipient_role);
        }

        $suggestions = $query->paginate(10);
        return view('kepala_sekolah.suggestions.index', compact('suggestions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $panitiaUsers = \App\Models\User::role('panitia')->get();
        $bendaharaUsers = \App\Models\User::role('bendahara')->get();

        return view('kepala_sekolah.suggestions.create', compact('panitiaUsers', 'bendaharaUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'recipient_type' => 'required|in:specific,role_panitia,role_bendahara',
            'recipient_id' => 'required_if:recipient_type,specific|exists:users,id',
        ]);

        $recipientRole = null;
        $recipientId = null;

        if ($request->recipient_type === 'specific') {
            $recipientId = $request->recipient_id;
            // Get user to check role, though logically we trust the ID valid
            $user = \App\Models\User::find($recipientId);
            $recipientRole = $user->getRoleNames()->first();
        } else {
            $recipientRole = $request->recipient_type === 'role_panitia' ? 'panitia' : 'bendahara';
            // Logic: If sending to a role, we might create notifications for ALL users in that role?
            // OR we change the requirement to "sending to a generic role bucket".
            // The prompt said: "beri saran ke user panitia / bendahara".
            // Let's implement creating a suggestion for EACH user in that role if selected,
            // OR keep it simple: Just one record with 'recipient_role' and no 'recipient_id',
            // AND the recipient index view will filter by role.
            // Let's go with the second approach for efficiency if "Broadcast" is intended.
            // But usually "Suggestion" is 1-to-1 or 1-to-many.
            // Let's create individual records if role is selected, so we can track read status individually.

            // For now, let's Stick to exact recipients OR generic role message.
            // Let's use the 'recipient_role' column we added.
        }

        if ($recipientId) {
            $suggestion = \App\Models\Suggestion::create([
                'sender_id' => \Illuminate\Support\Facades\Auth::id(),
                'recipient_id' => $recipientId,
                'recipient_role' => $recipientRole,
                'title' => $request->title,
                'message' => $request->message,
            ]);

            $user = \App\Models\User::find($recipientId);
            $user->notify(new \App\Notifications\NewSuggestion($suggestion));
        } else {
            // Broadcasting to all in role
            $users = \App\Models\User::role($recipientRole)->get();
            foreach ($users as $user) {
                $suggestion = \App\Models\Suggestion::create([
                    'sender_id' => \Illuminate\Support\Facades\Auth::id(),
                    'recipient_id' => $user->id,
                    'recipient_role' => $recipientRole,
                    'title' => $request->title,
                    'message' => $request->message,
                ]);

                $user->notify(new \App\Notifications\NewSuggestion($suggestion));
            }
        }

        return redirect()->route('kepala_sekolah.suggestions.index')->with('success', 'Saran berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Suggestion $suggestion)
    {
        $suggestion->load(['sender', 'recipient']);

        // Ensure only sender or recipient can view
        if (
            $suggestion->sender_id !== \Illuminate\Support\Facades\Auth::id() &&
            $suggestion->recipient_id !== \Illuminate\Support\Facades\Auth::id()
        ) {
            abort(403);
        }

        // Mark as read if viewer is recipient
        if ($suggestion->recipient_id === \Illuminate\Support\Facades\Auth::id() && !$suggestion->is_read) {
            $suggestion->update(['is_read' => true]);
        }

        return view('kepala_sekolah.suggestions.show', compact('suggestion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Suggestion $suggestion)
    {
        if ($suggestion->sender_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $panitiaUsers = \App\Models\User::role('panitia')->get();
        $bendaharaUsers = \App\Models\User::role('bendahara')->get();

        return view('kepala_sekolah.suggestions.edit', compact('suggestion', 'panitiaUsers', 'bendaharaUsers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Suggestion $suggestion)
    {
        if ($suggestion->sender_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $suggestion->update([
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return redirect()->route('kepala_sekolah.suggestions.index')->with('success', 'Saran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Suggestion $suggestion)
    {
        if ($suggestion->sender_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403);
        }

        $suggestion->delete();

        return redirect()->route('kepala_sekolah.suggestions.index')->with('success', 'Saran berhasil dihapus.');
    }
}

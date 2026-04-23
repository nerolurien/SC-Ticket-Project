<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    //
    public function store(Request $request, Ticket $ticket): RedirectResponse
    {

        $validated = $request->validate([
            'content' => 'required|string|min:3|max:2000',
        ], [
            'content.required' => 'Komentar tidak boleh kosong.',
            'content.min' => 'Komentar minimal 3 karakter.',
            'content.max' => 'Komentar maksimal 2000 karakter.',
        ]);

        $cleanContent = strip_tags($validated['content']);

        $comment = Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => 1, 
            'content' => $cleanContent,
        ]);

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
     
        $ticket = $comment->ticket;

        $comment->delete();

        return redirect()
            ->route('tickets.show', $ticket)
            ->with('success', 'Komentar berhasil dihapus!');
    }

    public function update(Request $request, Comment $comment): RedirectResponse
    {

        $validated = $request->validate([
            'content' => 'required|string|min:3|max:2000',
        ]);

        $cleanContent = strip_tags($validated['content']);

        $comment->update([
            'content' => $cleanContent,
        ]);

        return redirect()
            ->route('tickets.show', $comment->ticket)
            ->with('success', 'Komentar berhasil diperbarui!');
    }
}

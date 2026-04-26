<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function inbox()
    {
        $conversations = Message::where('receiver_id', Auth::id())
            ->orWhere('sender_id', Auth::id())
            ->with(['sender', 'receiver', 'listing'])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(function ($msg) {
                $other = $msg->sender_id === Auth::id() ? $msg->receiver_id : $msg->sender_id;
                return $other . '_' . ($msg->listing_id ?? 0);
            })
            ->map(fn($msgs) => $msgs->first());

        return view('messages.inbox', compact('conversations'));
    }

    public function conversation(User $user, Request $request)
    {
        $listingId = $request->query('listing');

        $messages = Message::where(function ($q) use ($user, $listingId) {
                $q->where('sender_id', Auth::id())->where('receiver_id', $user->id);
            })->orWhere(function ($q) use ($user, $listingId) {
                $q->where('sender_id', $user->id)->where('receiver_id', Auth::id());
            })
            ->when($listingId, fn($q) => $q->where('listing_id', $listingId))
            ->with(['sender', 'listing'])
            ->orderBy('created_at')
            ->get();

        Message::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('messages.conversation', compact('messages', 'user', 'listingId'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'body'        => 'required|string|max:2000',
            'receiver_id' => 'required|exists:users,id',
            'listing_id'  => 'nullable|exists:listings,id',
        ]);

        if ($request->receiver_id == Auth::id()) {
            return back()->with('error', 'Nevari sūtīt ziņu pats sev.');
        }

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'listing_id'  => $request->listing_id ?: null,
            'body'        => $request->body,
        ]);

        return redirect()->route('messages.conversation', [
            'user'    => $request->receiver_id,
            'listing' => $request->listing_id,
        ])->with('success', 'Ziņa nosūtīta!');
    }

    public function unreadCount()
    {
        return Message::where('receiver_id', Auth::id())->whereNull('read_at')->count();
    }
}

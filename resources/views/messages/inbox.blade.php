@extends('layouts.app')
@section('title', 'Iesūtne — AutoLog')
@section('content')
<div class="listings-page" style="max-width:700px;">
    <h1 class="page-heading">Iesūtne</h1>

    @if($conversations->isEmpty())
        <div class="empty-state">
            <p>Nav ziņu. Sazinies ar pārdevēju no sludinājuma lapas.</p>
        </div>
    @else
        <div style="display:flex; flex-direction:column; gap:8px;">
            @foreach($conversations as $msg)
                @php $other = $msg->sender_id === Auth::id() ? $msg->receiver : $msg->sender; @endphp
                <a href="{{ route('messages.conversation', ['user' => $other->id, 'listing' => $msg->listing_id]) }}"
                   style="display:flex; align-items:center; gap:14px; padding:16px 20px; background:var(--bg-card); border:1px solid var(--border); border-radius:var(--radius); text-decoration:none; transition:all 0.18s ease;"
                   onmouseover="this.style.borderColor='var(--border-light)'"
                   onmouseout="this.style.borderColor='var(--border)'">
                    <div style="width:40px; height:40px; border-radius:50%; background:var(--accent); display:flex; align-items:center; justify-content:center; font-weight:700; color:#111; flex-shrink:0;">
                        {{ strtoupper(substr($other->name, 0, 1)) }}
                    </div>
                    <div style="flex:1; min-width:0;">
                        <div style="display:flex; align-items:center; justify-content:space-between; gap:8px;">
                            <span style="font-weight:600; color:var(--text-primary); font-size:0.9rem;">{{ $other->name }}</span>
                            <span style="font-size:0.75rem; color:var(--text-muted);">{{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                        @if($msg->listing)
                            <div style="font-size:0.75rem; color:var(--accent); margin-bottom:2px;">{{ $msg->listing->brand }} {{ $msg->listing->model }}</div>
                        @endif
                        <div style="font-size:0.83rem; color:var(--text-secondary); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                            {{ $msg->sender_id === Auth::id() ? 'Tu: ' : '' }}{{ $msg->body }}
                        </div>
                    </div>
                    @if(!$msg->read_at && $msg->receiver_id === Auth::id())
                        <div style="width:8px; height:8px; border-radius:50%; background:var(--accent); flex-shrink:0;"></div>
                    @endif
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection

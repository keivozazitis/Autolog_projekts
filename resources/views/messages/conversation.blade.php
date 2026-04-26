@extends('layouts.app')
@section('title', 'Saruna ar ' . $user->name . ' — AutoLog')
@section('content')
<div style="max-width:700px; margin:0 auto; padding:24px 24px 0; display:flex; flex-direction:column; height:calc(100vh - 68px - 48px);">

    {{-- Header --}}
    <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px; flex-shrink:0;">
        <a href="{{ route('messages.inbox') }}" class="back-button">← Iesūtne</a>
        <div style="display:flex; align-items:center; gap:10px;">
            <div style="width:36px; height:36px; border-radius:50%; background:var(--accent); display:flex; align-items:center; justify-content:center; font-weight:700; color:#111; font-size:0.85rem;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <div style="font-weight:600; color:var(--text-primary);">{{ $user->name }}</div>
                @if($listingId && $messages->first()?->listing)
                    <div style="font-size:0.75rem; color:var(--accent);">
                        {{ $messages->first()->listing->brand }} {{ $messages->first()->listing->model }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Messages --}}
    <div id="messages-scroll" style="flex:1; overflow-y:auto; display:flex; flex-direction:column; gap:10px; padding-bottom:12px;">
        @forelse($messages as $msg)
            @php $mine = $msg->sender_id === Auth::id(); @endphp
            <div style="display:flex; justify-content:{{ $mine ? 'flex-end' : 'flex-start' }};">
                <div style="max-width:75%; padding:10px 16px; border-radius:{{ $mine ? '16px 16px 4px 16px' : '16px 16px 16px 4px' }}; background:{{ $mine ? 'var(--accent)' : 'var(--bg-elevated)' }}; color:{{ $mine ? '#111' : 'var(--text-primary)' }}; font-size:0.875rem; line-height:1.5;">
                    {{ $msg->body }}
                    <div style="font-size:0.7rem; opacity:0.6; margin-top:4px; text-align:right;">{{ $msg->created_at->format('H:i') }}</div>
                </div>
            </div>
        @empty
            <p style="color:var(--text-muted); text-align:center; padding:40px 0;">Sāc sarunu!</p>
        @endforelse
    </div>

    {{-- Input --}}
    <div style="flex-shrink:0; padding:12px 0 16px; border-top:1px solid var(--border);">
        <form method="POST" action="{{ route('messages.send') }}" style="display:flex; gap:10px; align-items:flex-end;">
            @csrf
            <input type="hidden" name="receiver_id" value="{{ $user->id }}">
            <input type="hidden" name="listing_id" value="{{ $listingId }}">
            <textarea name="body" placeholder="Raksti ziņu..." required
                style="flex:1; padding:10px 14px; background:var(--bg-input); border:1px solid var(--border); border-radius:var(--radius-sm); color:var(--text-primary); font-size:0.875rem; font-family:inherit; resize:none; height:48px; transition:border-color 0.18s;"
                onfocus="this.style.borderColor='var(--accent)'" onblur="this.style.borderColor='var(--border)'"></textarea>
            <button type="submit" class="button" style="flex-shrink:0;">Sūtīt</button>
        </form>
    </div>
</div>

<script>
    const el = document.getElementById('messages-scroll');
    if (el) el.scrollTop = el.scrollHeight;
</script>
@endsection

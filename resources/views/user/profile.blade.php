@extends('layouts.app')

@section('title', $user->name . ' — AutoLog')

@section('content')
<div class="profile-page">

    <div class="profile-card">
        <div class="profile-avatar">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        <h2 class="profile-name">{{ $user->name }}</h2>
        <p class="profile-email" style="color:var(--text-muted);">
            Reģistrējies {{ $user->created_at->format('d.m.Y') }}
        </p>
        <p style="color:var(--text-muted); font-size:0.85rem; margin-top:8px;">
            {{ $listings->count() }} {{ $listings->count() === 1 ? 'sludinājums' : 'sludinājumi' }}
        </p>
    </div>

    <div class="listings-page" style="padding:0; margin-top:40px;">
        <h2 class="page-heading" style="margin-bottom:24px;">{{ $user->name }} sludinājumi</h2>

        @if($listings->count())
        <div class="listings-grid">
            @foreach($listings as $listing)
            <div class="listing-card">
                <div class="listing-card-thumb">
                    @if($listing->images->first())
                        <img src="{{ asset($listing->images->first()->image_path) }}"
                             alt="{{ $listing->brand }} {{ $listing->model }}">
                    @else
                        <div class="listing-card-no-image">Nav attēla</div>
                    @endif
                </div>
                <div class="listing-card-body">
                    <h3 class="listing-card-title">
                        {{ $listing->brand }} {{ $listing->model }}
                        <span class="listing-card-year">({{ $listing->year }})</span>
                    </h3>
                    <div class="listing-card-price">€{{ number_format($listing->price, 2) }}</div>
                    <div class="listing-card-actions">
                        <a href="{{ route('listing.show', $listing->id) }}" style="flex:1;">
                            <button type="button" class="button" style="width:100%;">Apskatīt</button>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <p style="color:var(--text-muted);">Šim lietotājam nav aktīvu sludinājumu.</p>
        @endif
    </div>

</div>
@endsection

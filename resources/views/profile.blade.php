@extends('layouts.app')

@section('title', 'Profils — AutoLog')

@section('content')
<div class="profile-page">
    <div class="profile-card">
        <div class="profile-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <h2 class="profile-name">{{ Auth::user()->name }}</h2>
        <p class="profile-email">{{ Auth::user()->email }}</p>

        @if(Auth::user()->is_admin)
        <div style="margin-top: 20px;">
            <a href="{{ route('admin.index') }}" class="button" style="width:100%; display:block; text-align:center;">
                Admin panelis
            </a>
        </div>
        @endif

        <div class="profile-divider"></div>

        <div class="danger-zone">
            <p class="danger-zone-title">Bīstamā zona</p>
            <p class="danger-zone-desc">
                Konta dzēšana ir neatgriezeniska. Visi tavi sludinājumi un dati tiks neatgriezeniski izdzēsti.
            </p>
            <form method="POST" action="{{ route('account.delete') }}"
                  onsubmit="return confirm('Vai tiešām vēlies dzēst savu kontu?\n\nTIKS DZĒSTI arī visi tavi ievietotie sludinājumi!\n\nŠī darbība ir neatgriezeniska!');">
                @csrf
                @method('DELETE')
                <input type="password" name="password" placeholder="Apstipriniet paroli"
                       style="width:100%; margin-bottom:10px; padding:10px 14px; background:var(--bg-input); border:1px solid var(--border); border-radius:var(--radius-sm); color:var(--text-primary); font-size:0.875rem;" required>
                @error('password')
                    <p style="color:#e74c3c; font-size:0.8rem; margin-bottom:8px;">{{ $message }}</p>
                @enderror
                <button type="submit" class="button btn-danger">Dzēst kontu</button>
            </form>
        </div>
    </div>

    {{-- Mani sludinājumi --}}
    <div class="listings-page" style="padding: 0; margin-top: 40px;">
        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:24px;">
            <h2 class="page-heading" style="margin:0;">Mani sludinājumi</h2>
            <a href="/addListing" class="button">+ Ievietot jaunu</a>
        </div>

        @if($myListings->count())
        <div class="listings-grid">
            @foreach($myListings as $listing)
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
                        <a href="{{ route('listing.show', $listing->id) }}">
                            <button type="button" class="button btn-secondary">Apskatīt</button>
                        </a>
                        <a href="{{ route('listing.edit', $listing->id) }}">
                            <button type="button" class="button btn-secondary">Rediģēt</button>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
            <p style="color:var(--text-muted);">Tev vēl nav publicētu sludinājumu.</p>
        @endif
    </div>
</div>
@endsection

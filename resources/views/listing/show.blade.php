@extends('layouts.app')

@section('title', $listing->brand . ' ' . $listing->model . ' — AutoLog')

@push('styles')
@vite(['resources/js/addlisting.js'])
@endpush

@push('scripts')
<script>
let _lbImages = [], _lbIndex = 0;

function openLightbox(src) {
    _lbImages = Array.from(document.querySelectorAll('.gallery img')).map(i => i.src);
    _lbIndex = _lbImages.indexOf(src);
    _showLightboxImage();
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function _showLightboxImage() {
    document.getElementById('lightbox-img').src = _lbImages[_lbIndex];
    document.getElementById('lb-counter').textContent = (_lbIndex + 1) + ' / ' + _lbImages.length;
    document.getElementById('lb-prev').style.display = _lbImages.length > 1 ? 'flex' : 'none';
    document.getElementById('lb-next').style.display = _lbImages.length > 1 ? 'flex' : 'none';
}
function lbPrev(e) { e.stopPropagation(); _lbIndex = (_lbIndex - 1 + _lbImages.length) % _lbImages.length; _showLightboxImage(); }
function lbNext(e) { e.stopPropagation(); _lbIndex = (_lbIndex + 1) % _lbImages.length; _showLightboxImage(); }
function closeLightbox() {
    document.getElementById('lightbox').classList.remove('open');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') { if(document.getElementById('lightbox').classList.contains('open')) { _lbIndex = (_lbIndex - 1 + _lbImages.length) % _lbImages.length; _showLightboxImage(); } }
    if (e.key === 'ArrowRight') { if(document.getElementById('lightbox').classList.contains('open')) { _lbIndex = (_lbIndex + 1) % _lbImages.length; _showLightboxImage(); } }
});
</script>
@endpush

@section('content')
<div class="listing-detail">

    {{-- ── Header ── --}}
    <div class="listing-detail-header">
        <h1 class="listing-title">
            {{ $listing->brand }} {{ $listing->model }}
            <span style="font-weight:400; color: var(--text-secondary);">({{ $listing->year }})</span>
        </h1>
        <div class="price-tag">€{{ number_format($listing->price, 2) }}</div>
    </div>

    @if($listing->user)
    <div style="margin-bottom:20px;">
        <a href="{{ route('user.profile', $listing->user->id) }}"
           style="display:inline-flex; align-items:center; gap:10px; text-decoration:none; color:var(--text-secondary); font-size:0.875rem; transition:color 0.15s;"
           onmouseover="this.style.color='var(--text-primary)'" onmouseout="this.style.color='var(--text-secondary)'">
            <span style="width:32px; height:32px; border-radius:50%; background:var(--bg-elevated); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; font-weight:600; font-size:0.8rem; color:var(--accent); flex-shrink:0;">
                {{ strtoupper(substr($listing->user->name, 0, 1)) }}
            </span>
            {{ $listing->user->name }}
        </a>
    </div>
    @endif

    {{-- ── Pamatinformācija ── --}}
    <div class="details-card">
        <h2 class="details-title">Pamatinformācija</h2>
        <div class="spec-grid">
            <div class="spec-item">
                <span class="spec-label">Marka</span>
                <span class="spec-value">{{ $listing->brand }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Modelis</span>
                <span class="spec-value">{{ $listing->model }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Gads</span>
                <span class="spec-value">{{ $listing->year }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Virsbūves tips</span>
                <span class="spec-value">{{ $listing->body_type ?: '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Degvielas tips</span>
                <span class="spec-value">{{ $listing->fuel_type ?: '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Ātrumkārba</span>
                <span class="spec-value">{{ $listing->transmission ?: '—' }}</span>
            </div>
        </div>
    </div>

    {{-- ── Tehniskie dati ── --}}
    <div class="details-card">
        <h2 class="details-title">Tehniskie dati</h2>
        <div class="spec-grid">
            <div class="spec-item">
                <span class="spec-label">Dzinēja tilpums</span>
                <span class="spec-value">{{ $listing->engine_volume ? $listing->engine_volume . ' cm³' : '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Nobraukums</span>
                <span class="spec-value">{{ $listing->mileage ? number_format($listing->mileage) . ' km' : '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Krāsa</span>
                <span class="spec-value">{{ $listing->color ?: '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Numurzīme</span>
                <span class="spec-value">{{ $listing->license_plate ?: '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">VIN kods</span>
                <span class="spec-value" style="word-break:break-all;">{{ $listing->vin ?: '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Nākamā apskate</span>
                <span class="spec-value">{{ $listing->next_inspection ?: '—' }}</span>
            </div>
        </div>
    </div>

    {{-- ── Apraksts ── --}}
    @if($listing->description)
    <div class="details-card">
        <h2 class="details-title">Apraksts</h2>
        <p style="color: var(--text-secondary); line-height: 1.7; margin: 0;">{{ $listing->description }}</p>
    </div>
    @endif

    {{-- ── Galerija ── --}}
    @if($listing->images->count())
    <div class="details-card">
        <h2 class="details-title">Galerija — klikšķini uz bildi pilnekrāna skatam</h2>
        <div class="gallery">
            @foreach ($listing->images as $image)
                <img src="{{ asset($image->image_path) }}"
                     alt="{{ $listing->brand }} {{ $listing->model }}"
                     onclick="openLightbox(this.src)">
            @endforeach
        </div>
    </div>
    @endif

    {{-- Lightbox --}}
    <div class="lightbox-overlay" id="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close" onclick="closeLightbox()">&#x2715;</button>
        <button id="lb-prev" class="lb-nav lb-prev" onclick="lbPrev(event)">&#8592;</button>
        <img id="lightbox-img" src="" alt="Pilnekrāna attēls" onclick="event.stopPropagation()">
        <button id="lb-next" class="lb-nav lb-next" onclick="lbNext(event)">&#8594;</button>
        <span id="lb-counter" class="lb-counter"></span>
    </div>

    {{-- ── Tehniskā apskate ── --}}
    <div class="details-card">
        <h2 class="details-title">Tehniskā apskate</h2>
        <div class="spec-grid">
            <div class="spec-item">
                <span class="spec-label">Iepriekšējās apskates vērtējums</span>
                @if($listing->prev_inspection_rating)
                    <div class="inspection-rating" style="margin-top:6px;">
                        <div class="rating-circle rating-{{ $listing->prev_inspection_rating }}">
                            {{ $listing->prev_inspection_rating }}
                        </div>
                        <span class="spec-value">
                            @if($listing->prev_inspection_rating == 0) Viss kārtībā (bez defektiem)
                            @elseif($listing->prev_inspection_rating == 1) Sīks trūkums vai bojājums
                            @elseif($listing->prev_inspection_rating == 2) Būtisks trūkums vai bojājums
                            @else Bīstams trūkums vai bojājums
                            @endif
                        </span>
                    </div>
                @else
                    <span class="spec-value">Nav norādīts</span>
                @endif
            </div>

            @if($listing->prev_inspection_problem)
            <div class="spec-item">
                <span class="spec-label">Konstatētās nepilnības</span>
                <span class="spec-value">{{ $listing->prev_inspection_problem }}</span>
            </div>
            @endif
        </div>
    </div>

    <div style="display:flex; gap:12px; align-items:center; flex-wrap:wrap;">
        <a href="{{ url()->previous() }}" class="back-button" style="margin-top:0;">&#8592; Atpakaļ</a>
        @auth
            @if(Auth::id() === $listing->user_id || Auth::user()->is_admin)
                <a href="{{ route('listing.edit', $listing->id) }}" class="button btn-secondary">Rediģēt</a>
            @endif
        @endauth
    </div>
</div>
@endsection

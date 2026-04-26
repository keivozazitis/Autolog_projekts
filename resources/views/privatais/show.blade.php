@extends('layouts.app')

@section('title', $ieraksts->brand . ' ' . $ieraksts->model . ' — Mans katalogs')

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

    <div class="listing-detail-header">
        <h1 class="listing-title">
            {{ $ieraksts->brand }} {{ $ieraksts->model }}
            <span style="font-weight:400; color: var(--text-secondary);">({{ $ieraksts->year }})</span>
        </h1>
        <div class="price-tag">€{{ number_format($ieraksts->price, 0) }}</div>
    </div>

    {{-- Pamatinformācija --}}
    <div class="details-card">
        <h2 class="details-title">Pamatinformācija</h2>
        <div class="spec-grid">
            <div class="spec-item">
                <span class="spec-label">Marka</span>
                <span class="spec-value">{{ $ieraksts->brand }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Modelis</span>
                <span class="spec-value">{{ $ieraksts->model }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Gads</span>
                <span class="spec-value">{{ $ieraksts->year }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Virsbūves tips</span>
                <span class="spec-value">{{ $ieraksts->body_type ?: '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Degvielas tips</span>
                <span class="spec-value">{{ $ieraksts->fuel_type ?: '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Ātrumkārba</span>
                <span class="spec-value">{{ $ieraksts->transmission ?: '—' }}</span>
            </div>
        </div>
    </div>

    {{-- Tehniskie dati --}}
    <div class="details-card">
        <h2 class="details-title">Tehniskie dati</h2>
        <div class="spec-grid">
            <div class="spec-item">
                <span class="spec-label">Dzinēja tilpums</span>
                <span class="spec-value">{{ $ieraksts->engine_volume ? $ieraksts->engine_volume . ' cm³' : '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Nobraukums</span>
                <span class="spec-value">{{ $ieraksts->mileage ? number_format($ieraksts->mileage) . ' km' : '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Krāsa</span>
                <span class="spec-value">{{ $ieraksts->color ?: '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Numurzīme</span>
                <span class="spec-value">{{ $ieraksts->license_plate ?: '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">VIN kods</span>
                <span class="spec-value" style="word-break:break-all;">{{ $ieraksts->vin ?: '—' }}</span>
            </div>
            <div class="spec-item">
                <span class="spec-label">Nākamā apskate</span>
                <span class="spec-value">{{ $ieraksts->next_inspection ?: '—' }}</span>
            </div>
        </div>
    </div>

    {{-- Tehniskā apskate --}}
    @if($ieraksts->prev_inspection_rating || $ieraksts->prev_inspection_problem)
    <div class="details-card">
        <h2 class="details-title">Tehniskā apskate</h2>
        <div class="spec-grid">
            @if($ieraksts->prev_inspection_rating)
            <div class="spec-item">
                <span class="spec-label">Iepriekšējās apskates vērtējums</span>
                <div class="inspection-rating" style="margin-top:6px;">
                    <div class="rating-circle rating-{{ $ieraksts->prev_inspection_rating }}">
                        {{ $ieraksts->prev_inspection_rating }}
                    </div>
                    <span class="spec-value">
                        @if($ieraksts->prev_inspection_rating == 0) Viss kārtībā (bez defektiem)
                        @elseif($ieraksts->prev_inspection_rating == 1) Sīks trūkums vai bojājums
                        @elseif($ieraksts->prev_inspection_rating == 2) Būtisks trūkums vai bojājums
                        @else Bīstams trūkums vai bojājums
                        @endif
                    </span>
                </div>
            </div>
            @endif
            @if($ieraksts->prev_inspection_problem)
            <div class="spec-item">
                <span class="spec-label">Konstatētās nepilnības</span>
                <span class="spec-value">{{ $ieraksts->prev_inspection_problem }}</span>
            </div>
            @endif
        </div>
    </div>
    @endif

    {{-- Galerija --}}
    @if($ieraksts->images->count())
    <div class="details-card">
        <h2 class="details-title">Galerija</h2>
        <div class="gallery">
            @foreach ($ieraksts->images as $image)
                <img src="{{ asset($image->image_path) }}"
                     alt="{{ $ieraksts->brand }} {{ $ieraksts->model }}"
                     onclick="openLightbox(this.src)">
            @endforeach
        </div>
    </div>
    @endif

    <div class="lightbox-overlay" id="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close" onclick="closeLightbox()">&#x2715;</button>
        <button id="lb-prev" class="lb-nav lb-prev" onclick="lbPrev(event)">&#8592;</button>
        <img id="lightbox-img" src="" alt="" onclick="event.stopPropagation()">
        <button id="lb-next" class="lb-nav lb-next" onclick="lbNext(event)">&#8594;</button>
        <span id="lb-counter" class="lb-counter"></span>
    </div>

    {{-- Apraksts --}}
    @if($ieraksts->description)
    <div class="details-card">
        <h2 class="details-title">Apraksts</h2>
        <p style="color: var(--text-secondary); line-height: 1.7; margin: 0;">{{ $ieraksts->description }}</p>
    </div>
    @endif

    {{-- Darbības --}}
    <div style="display:flex; gap:12px; align-items:center; flex-wrap:wrap; margin-top:8px;">
        <a href="{{ route('privatais.index') }}" class="back-button" style="margin-top:0;">&#8592; Atpakaļ uz katalogu</a>

        <form action="{{ route('privatais.publish', $ieraksts->id) }}" method="POST"
              onsubmit="return confirm('Publicēt šo auto kā publisku sludinājumu?')"
              style="margin:0;">
            @csrf
            <button type="submit" class="button">
                &#8679; Publicēt kā sludinājumu
            </button>
        </form>

        <form action="{{ route('privatais.destroy', $ieraksts->id) }}" method="POST"
              onsubmit="return confirm('Vai tiešām dzēst šo ierakstu?')"
              style="margin:0;">
            @csrf
            @method('DELETE')
            <button type="submit" class="button"
                    style="background:transparent; border:1px solid #c0392b; color:#e74c3c;">
                Dzēst ierakstu
            </button>
        </form>
    </div>

</div>
@endsection

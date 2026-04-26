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

    <a href="{{ route('listing.index') }}" class="back-button" style="display:inline-flex; margin-bottom:16px;">← Atpakaļ uz sludinājumiem</a>

    {{-- ── Header ── --}}
    <div class="listing-detail-header">
        <h1 class="listing-title">
            {{ $listing->brand }} {{ $listing->model }}
            <span style="font-weight:400; color: var(--text-secondary);">({{ $listing->year }})</span>
        </h1>
        <div class="price-tag">€{{ number_format($listing->price, 0) }}</div>
    </div>

    <div style="margin-bottom:20px; display:flex; align-items:center; flex-wrap:wrap; gap:16px;">
        @if($listing->user)
        <a href="{{ route('user.profile', $listing->user->id) }}"
           style="display:inline-flex; align-items:center; gap:10px; text-decoration:none; color:var(--text-secondary); font-size:0.875rem; transition:color 0.15s;"
           onmouseover="this.style.color='var(--text-primary)'" onmouseout="this.style.color='var(--text-secondary)'">
            <span style="width:32px; height:32px; border-radius:50%; background:var(--bg-elevated); border:1px solid var(--border); display:flex; align-items:center; justify-content:center; font-weight:600; font-size:0.8rem; color:var(--accent); flex-shrink:0;">
                {{ strtoupper(substr($listing->user->name, 0, 1)) }}
            </span>
            {{ $listing->user->name }}
        </a>
        @endif
        @if($listing->phone)
        <a href="tel:{{ $listing->phone }}"
           style="display:inline-flex; align-items:center; gap:8px; text-decoration:none; color:var(--text-secondary); font-size:0.875rem; background:var(--bg-elevated); border:1px solid var(--border); border-radius:var(--radius-sm); padding:6px 14px; transition:all 0.15s;"
           onmouseover="this.style.borderColor='var(--accent)';this.style.color='var(--text-primary)'"
           onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-secondary)'">
            &#128222; {{ $listing->phone }}
        </a>
        @endif
        @auth
            @if($listing->user_id !== Auth::id())
            <a href="{{ route('messages.conversation', ['user' => $listing->user_id, 'listing' => $listing->id]) }}"
               class="button btn-secondary btn-sm">
                ✉ Sazināties
            </a>
            @endif
        @endauth
    </div>

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
    @php
    $ratingLabels = [
        '0' => 'Viss kārtībā (bez defektiem)',
        '1' => 'Sīks trūkums vai bojājums',
        '2' => 'Būtisks trūkums vai bojājums',
        '3' => 'Bīstams trūkums vai bojājums',
    ];
    $problemLabels = [
        'numura_zimes_apgaismojums'  => 'Numura zīmes apgaismojums nedarbojas',
        'luktura_stikla_bojajums'    => 'Neliels luktura stikla bojājums',
        'lukturu_regulejums'         => 'Lukturu regulējums nedaudz neatbilst normām',
        'ellas_svisana'              => 'Neliela eļļas svīšana no dzinēja',
        'riepu_nodilums'             => 'Neliels riepu nodilums',
        'bremzu_disku_nodilums'      => 'Neliels bremžu disku nodilums',
        'korozija_virsbuve'          => 'Neliela korozija uz virsbūves elementiem',
        'brivkustiba_balstiekarta'   => 'Neliela brīvkustība balstiekārtas savienojumos',
        'salona_bojajumi'            => 'Salona aprīkojuma bojājumi',
        'izpludes_stiprinajums'      => 'Neliels izplūdes sistēmas stiprinājuma bojājums',
        'logu_tiritalji'             => 'Logu tīrītāju darbība nepietiekama',
        'stikla_bojajums'            => 'Neliels stikla bojājums ārpus redzamības zonas',
        'dzesesanas_noplude'         => 'Neliela dzesēšanas šķidruma noplūde',
        'degvielas_svisana'          => 'Neliela degvielas sistēmas svīšana',
        'troksna_parsneigums'        => 'Neliels trokšņa līmeņa pārsniegums',
        'vibracija_bremzesana'       => 'Neliela vibrācija bremzēšanas laikā',
        'amortizatora_samazinajums'  => 'Neliels amortizatora efektivitātes samazinājums',
        'elektroinstalacija_izolacija' => 'Neliela elektroinstalācijas izolācijas bojājuma pazīme',
        'papildaprikojums_nepilnigas'=> 'Papildaprīkojums uzstādīts ar nebūtiskām nepilnībām',
        'virsbuve_deformacija'       => 'Neliela virsbūves deformācija bez ietekmes uz drošību',
        'bremzu_speks_nepietiekams'  => 'Bremžu spēks nepietiekams',
        'nevienmerigas_bremzes'      => 'Nevienmērīga bremzēšana uz vienas ass',
        'rokas_bremze'               => 'Rokas bremze nedarbojas efektīvi',
        'lukturu_regulejums_butisks' => 'Lukturu regulējums būtiski neatbilst normām',
        'tuvais_lukturis_nedarbojas' => 'Nestrādā viens no tuvās gaismas lukturiem',
        'pagrieziena_raditajs'       => 'Pagrieziena rādītājs nedarbojas',
        'riepu_protektors_zem_normas'=> 'Riepu protektora dziļums zem minimālās normas',
        'riepa_bojata'               => 'Riepa bojāta (plaisa vai izspiedums)',
        'stūres_brivkustiba'         => 'Stūres mehānismā pārmērīga brīvkustība',
        'amortizators_nepietiekams'  => 'Amortizatora darbība nepietiekama',
        'lodbalsts_nodilums'         => 'Lodbalsts ar pārmērīgu nodilumu',
        'izpludes_emisija'           => 'Izplūdes gāzu emisija pārsniedz normu',
        'dumainiba'                  => 'Dūmainība pārsniedz pieļaujamo līmeni',
        'izpludes_sistema_bojata'    => 'Izplūdes sistēma bojāta vai nehermētiska',
        'vejstikls_bojats'           => 'Vējstikls bojāts redzamības zonā',
        'logu_tiritalji_nedarbojas'  => 'Logu tīrītāji nedarbojas',
        'drosibas_josta'             => 'Drošības josta bojāta vai nedarbojas',
        'degvielas_noplude'          => 'Degvielas sistēmas noplūde',
        'ellas_noplude'              => 'Eļļas noplūde no dzinēja',
        'nesoso_elementu_korozija'   => 'Nesošo elementu korozija',
        'bremzu_sistema_nedarbojas'  => 'Bremžu sistēma nedarbojas',
        'bremzu_skiduma_noplude'     => 'Bremžu šķidruma intensīva noplūde',
        'bremzu_speka_neesamiba'     => 'Pilnīga bremžu spēka neesamība uz ass',
        'stūres_mehānisma_bojajums'  => 'Stūres mehānisma bojājums',
        'stūres_vadamiba'            => 'Stūres vadāmība apdraudēta',
        'ritenis_nenostiprināts'     => 'Ritenis nav droši nostiprināts',
        'riepa_kritisks_bojajums'    => 'Riepa ar kritisku bojājumu (plīsuma risks)',
        'atsperes_luzums'            => 'Atsperes lūzums',
        'balstiekarta_atvienota'     => 'Balstiekārtas detaļa atvienota vai salūzusi',
        'ramis_kritiski_bojats'      => 'Rāmis vai nesošā konstrukcija kritiski bojāta',
        'degviela_aizdegšanas_risks' => 'Degvielas noplūde ar aizdegšanās risku',
        'izpludes_atdalita'          => 'Izplūdes sistēma atdalīta vai nokritusi',
        'redzamiba_ierobezota'       => 'Redzamība būtiski ierobežota',
        'durvis_neaizveras'          => 'Vadītāja durvis nevar droši aizvērt',
        'drosibas_josta_kritiski'    => 'Drošības josta nedarbojas kritiski',
        'kravas_nostiprinas_bistams' => 'Kravas nostiprinājums bīstams satiksmei',
        'tiess_apdraudejums'         => 'Transportlīdzeklis rada tiešu apdraudējumu satiksmei',
        'konstrukcijas_bojajums'     => 'Būtisks konstrukcijas bojājums',
        'elektriba_aizdegšanas_risks'=> 'Elektriskās sistēmas bojājums ar aizdegšanās risku',
        'stavoklis_bistams'          => 'Transportlīdzekļa tehniskais stāvoklis bīstams ekspluatācijai',
    ];
    $problems = $listing->prev_inspection_problem
        ? array_filter(array_map('trim', explode(',', $listing->prev_inspection_problem)))
        : [];
    $ratingCounts = $listing->prev_inspection_ratings ?: null;
    @endphp
    <div class="details-card">
        <h2 class="details-title">Tehniskā apskate</h2>
        <div class="spec-grid">
            <div class="spec-item" style="grid-column: 1 / -1;">
                <span class="spec-label">Iepriekšējās apskates vērtējums</span>
                @if($ratingCounts && array_sum($ratingCounts) > 0)
                    <div style="margin-top:10px; display:flex; flex-direction:column; gap:8px;">
                        @foreach(['0','1','2','3'] as $level)
                            @if(!empty($ratingCounts[$level]))
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div class="rating-circle rating-{{ $level }}" style="flex-shrink:0;">{{ $level }}</div>
                                <span class="spec-value" style="flex:1;">{{ $ratingLabels[$level] }}</span>
                                <span style="background:var(--bg-elevated); border:1px solid var(--border); border-radius:var(--radius-sm); padding:2px 10px; font-size:0.8rem; color:var(--text-muted); font-weight:600;">
                                    {{ $ratingCounts[$level] }}×
                                </span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <span class="spec-value" style="margin-top:6px; display:inline-block;">Nav norādīts</span>
                @endif
            </div>

            @if(count($problems))
            <div class="spec-item" style="grid-column: 1 / -1;">
                <span class="spec-label">Konstatētās nepilnības</span>
                <ul style="margin:8px 0 0; padding-left:18px; color:var(--text-secondary); font-size:0.875rem; line-height:1.8;">
                    @foreach($problems as $p)
                        <li>{{ $problemLabels[$p] ?? $p }}</li>
                    @endforeach
                </ul>
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

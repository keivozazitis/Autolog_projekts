@extends('layouts.app')

@section('title', 'Sludinājumi — AutoLog')

@section('content')
<div class="listings-page">
    <h1 class="page-heading">Sludinājumi</h1>

    {{-- ── Filter dropdown ── --}}
    <div class="filter-dropdown" id="filterDropdown">
        <button class="filter-dropdown-toggle" id="filterToggleBtn" type="button">
            Filtrēt sludinājumus <span class="arrow-down"></span>
        </button>

        <div class="filter-dropdown-content">
            <section class="Auto-markas">
                <form id="filter-form" method="GET" action="/sludinajumi">
                    {{-- Marka --}}
                    <div class="filter-group">
                        <label for="brand">Marka</label>
                        <select id="brand" name="brand">
                            <option value="">Visi</option>
                            <option value="alfaromeo">Alfa Romeo</option>
                            <option value="audi">Audi</option>
                            <option value="bmw">BMW</option>
                            <option value="chevrolet">Chevrolet</option>
                            <option value="chrysler">Chrysler</option>
                            <option value="citroen">Citroen</option>
                            <option value="cupra">Cupra</option>
                            <option value="dacia">Dacia</option>
                            <option value="dodge">Dodge</option>
                            <option value="fiat">Fiat</option>
                            <option value="ford">Ford</option>
                            <option value="honda">Honda</option>
                            <option value="hyundai">Hyundai</option>
                            <option value="infiniti">Infiniti</option>
                            <option value="jaguar">Jaguar</option>
                            <option value="jeep">Jeep</option>
                            <option value="kia">Kia</option>
                            <option value="lancia">Lancia</option>
                            <option value="landrover">Land Rover</option>
                            <option value="lexus">Lexus</option>
                            <option value="mazda">Mazda</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="mini">Mini</option>
                            <option value="mitsubishi">Mitsubishi</option>
                            <option value="nissan">Nissan</option>
                            <option value="opel">Opel</option>
                            <option value="peugeot">Peugeot</option>
                            <option value="porsche">Porsche</option>
                            <option value="renault">Renault</option>
                            <option value="saab">Saab</option>
                            <option value="seat">Seat</option>
                            <option value="skoda">Skoda</option>
                            <option value="smart">Smart</option>
                            <option value="subaru">Subaru</option>
                            <option value="suzuki">Suzuki</option>
                            <option value="tesla">Tesla</option>
                            <option value="toyota">Toyota</option>
                            <option value="volkswagen">Volkswagen</option>
                            <option value="volvo">Volvo</option>
                            <option value="gaz">Gaz</option>
                            <option value="uaz">Uaz</option>
                            <option value="vaz">Vaz</option>
                            <option value="citas markas">Citas markas</option>
                        </select>
                    </div>

                    {{-- Modelis --}}
                    <div class="filter-group">
                        <label for="model">Modelis</label>
                        <select id="model" name="model" disabled>
                            <option value="">Vispirms izvēlies marku</option>
                        </select>
                    </div>

                    {{-- Gads --}}
                    <div class="filter-group">
                        <label for="year">Gads</label>
                        <select name="year" id="year">
                            <option value="">Visi gadi</option>
                            @php $currentYear = date('Y'); @endphp
                            @for ($y = $currentYear; $y >= 1950; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Cena --}}
                    <div class="filter-row">
                        <div class="filter-group">
                            <label for="price-from">Cena no (€)</label>
                            <input type="number" id="price-from" name="price-from" placeholder="0">
                        </div>
                        <div class="filter-group">
                            <label for="price-to">Cena līdz (€)</label>
                            <input type="number" id="price-to" name="price-to" placeholder="50000">
                        </div>
                    </div>

                    {{-- Virsbūves tips --}}
                    <div class="filter-group">
                        <label for="body-type">Virsbūves tips</label>
                        <select id="body-type" name="body-type">
                            <option value="">Visi</option>
                            <option value="sedans">Sedans</option>
                            <option value="universalis">Universālis</option>
                            <option value="kupeja">Kupeja</option>
                            <option value="hecbeks">Hečbeks</option>
                            <option value="suv">SUV</option>
                            <option value="kabriolets">Kabriolets</option>
                            <option value="pikaps">Pikaps</option>
                            <option value="minivens">Minivens</option>
                        </select>
                    </div>

                    {{-- Degvielas tips --}}
                    <div class="filter-group">
                        <label for="fuel-type">Degvielas tips</label>
                        <select id="fuel-type" name="fuel-type">
                            <option value="">Visi</option>
                            <option value="elektrisks">Elektrisks</option>
                            <option value="benzins">Benzīns</option>
                            <option value="dizelis">Dīzelis</option>
                            <option value="benzins-gaze">Benzīns + Gāze</option>
                            <option value="hibrids">Hibrīds</option>
                        </select>
                    </div>

                    {{-- Ātrumkārba --}}
                    <div class="filter-group">
                        <label for="trans-type">Ātrumkārba</label>
                        <select id="trans-type" name="trans-type">
                            <option value="">Visi</option>
                            <option value="Automats">Automāts</option>
                            <option value="Manuals">Manuāls</option>
                            <option value="Sequential">Sequential</option>
                        </select>
                    </div>

                    {{-- Dzinēja tilpums --}}
                    <div class="filter-row">
                        <div class="filter-group">
                            <label for="engine-volume-from">Dzinējs no (cm³)</label>
                            <input type="number" id="engine-volume-from" name="engine-volume-from" placeholder="1000">
                        </div>
                        <div class="filter-group">
                            <label for="engine-volume-to">Dzinējs līdz (cm³)</label>
                            <input type="number" id="engine-volume-to" name="engine-volume-to" placeholder="5000">
                        </div>
                    </div>

                    <div class="filter-submit-row">
                        <button type="submit" class="button">Meklēt</button>
                    </div>
                </form>
            </section>
        </div>
    </div>

    {{-- ── Listing cards grid ── --}}
    <div class="listings-grid">
        @forelse ($listings as $listing)
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
                    @if($listing->description)
                        <p class="listing-card-desc">{{ $listing->description }}</p>
                    @endif

                    <div class="listing-card-actions">
                        <a href="{{ route('listing.show', $listing->id) }}">
                            <button type="button" class="button">Apskatīt</button>
                        </a>
                        @auth
                            @if(Auth::id() === $listing->user_id || Auth::user()->is_admin)
                            <form action="{{ route('listing.destroy', $listing->id) }}" method="POST"
                                  onsubmit="return confirm('Dzēst šo sludinājumu?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button btn-danger">Dzēst</button>
                            </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p>Nav pieejamu sludinājumu.</p>
            </div>
        @endforelse
    </div>

    @if($listings->hasPages())
    <div class="pagination-wrap">
        {{ $listings->links() }}
    </div>
    @endif

</div>
@endsection

@push('scripts')
<script>
    const btn = document.getElementById('filterToggleBtn');
    const dropdown = document.getElementById('filterDropdown');
    if (btn && dropdown) {
        btn.addEventListener('click', () => dropdown.classList.toggle('active'));
    }
</script>
@endpush

@extends('layouts.app')

@section('title', 'Ievietot sludinājumu — AutoLog')

@push('styles')
@vite(['resources/js/addlisting.js'])
@endpush

@section('content')
<div class="form-page">
    <h1 class="form-page-title">Ievietot sludinājumu</h1>

    <div class="form-card">
        <form action="{{ route('listing.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">

                {{-- ── Attēli ── --}}
                <div class="filter-group full-width">
                    <label for="images">Pievienot bildes</label>
                    <input type="file" id="images" name="images[]" accept="image/*" multiple>
                    <div class="image-previews" id="preview-container"></div>
                </div>

                {{-- ── Marka & Modelis ── --}}
                <div class="filter-group">
                    <label for="brand">Marka *</label>
                    <select id="brand" name="brand" required>
                        <option value="">Izvēlies marku</option>
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
                        <option value="citas">Citas markas</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="model">Modelis *</label>
                    <select id="model" name="model" required>
                        <option value="">Vispirms izvēlies marku</option>
                    </select>
                </div>

                {{-- ── Gads & Cena ── --}}
                <div class="filter-group">
                    <label for="year">Izlaiduma gads *</label>
                    <select name="year" id="year" required>
                        <option value="">Izvēlies gadu</option>
                        @for ($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>

                <div class="filter-group">
                    <label for="price">Cena (€) *</label>
                    <input type="number" id="price" name="price" placeholder="6500" min="0" step="0.01" required>
                </div>

                {{-- ── Virsbūve & Degviela & Ātrumkārba ── --}}
                <div class="filter-group">
                    <label for="body_type">Virsbūves tips</label>
                    <select id="body_type" name="body_type">
                        <option value="">Izvēlies</option>
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

                <div class="filter-group">
                    <label for="fuel_type">Degvielas tips</label>
                    <select id="fuel_type" name="fuel_type">
                        <option value="">Izvēlies</option>
                        <option value="elektrisks">Elektrisks</option>
                        <option value="benzins">Benzīns</option>
                        <option value="dizelis">Dīzelis</option>
                        <option value="benzins-gaze">Benzīns + Gāze</option>
                        <option value="hibrids">Hibrīds</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="transmission">Ātrumkārba</label>
                    <select id="transmission" name="transmission">
                        <option value="">Izvēlies</option>
                        <option value="automats">Automāts</option>
                        <option value="manuals">Manuāls</option>
                        <option value="sequential">Sequential</option>
                    </select>
                </div>

                {{-- ── Tehniskie dati ── --}}
                <div class="filter-group">
                    <label for="engine_volume">Dzinēja tilpums (cm³)</label>
                    <input type="number" id="engine_volume" name="engine_volume" placeholder="1600">
                </div>

                <div class="filter-group">
                    <label for="mileage">Nobraukums (km)</label>
                    <input type="number" id="mileage" name="mileage" placeholder="100000">
                </div>

                <div class="filter-group">
                    <label for="color">Krāsa</label>
                    <input type="text" id="color" name="color" placeholder="Melna">
                </div>

                <div class="filter-group">
                    <label for="license_plate">Numurzīme</label>
                    <input type="text" id="license_plate" name="license_plate" placeholder="ABC-1234">
                </div>

                <div class="filter-group">
                    <label for="vin">VIN kods</label>
                    <input type="text" id="vin" name="vin" placeholder="1HGCM82633A004352">
                </div>

                <div class="filter-group">
                    <label for="next_inspection">Nākamā apskate</label>
                    <input type="date" id="next_inspection" name="next_inspection">
                </div>

                {{-- ── Apskate ── --}}
                <div class="filter-group">
                    <label for="prev_inspection_rating">Iepriekšējās apskates vērtējums</label>
                    <select id="prev_inspection_rating" name="prev_inspection_rating">
                        <option value="">Izvēlies</option>
                        <option value="0">0 — Viss kārtībā (bez defektiem)</option>
                        <option value="1">1 — Sīks trūkums vai bojājums</option>
                        <option value="2">2 — Būtisks trūkums vai bojājums</option>
                        <option value="3">3 — Bīstams trūkums vai bojājums</option>
                    </select>
                </div>

                <div class="filter-group" id="problem-group" style="display: none;">
                    <label for="prev_inspection_problem">Problēma</label>
                    <select id="prev_inspection_problem" name="prev_inspection_problem"></select>
                </div>

                {{-- ── Apraksts ── --}}
                <div class="filter-group full-width">
                    <label for="description">Apraksts</label>
                    <textarea id="description" name="description" rows="4"
                              placeholder="Papildus informācija par automašīnu..."></textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="button" id="submitBtn">Ievietot sludinājumu</button>
                    <a href="/sludinajumi" class="button btn-secondary">Atcelt</a>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelector('form').addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.textContent = 'Saglabā...';
    btn.style.opacity = '0.6';
    btn.style.cursor = 'not-allowed';
});

document.getElementById('images').addEventListener('change', function(e) {
    const container = document.getElementById('preview-container');
    container.innerHTML = '';
    Array.from(e.target.files).forEach(file => {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = ev => {
            const img = document.createElement('img');
            img.src = ev.target.result;
            container.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush

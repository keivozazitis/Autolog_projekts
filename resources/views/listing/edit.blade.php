@extends('layouts.app')

@section('title', 'Rediģēt sludinājumu — AutoLog')

@push('styles')
@vite(['resources/js/addlisting.js'])
@endpush

@section('content')
<div class="form-page">
    <h1 class="form-page-title">Rediģēt sludinājumu</h1>

    <div class="form-card">
        <form action="{{ route('listing.update', $listing->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-grid">

                {{-- Esošās bildes --}}
                @if($listing->images->count())
                <div class="filter-group full-width">
                    <label>Esošās bildes <span style="color:var(--text-muted); font-weight:400;">(atzīmē ko dzēst)</span></label>
                    <div style="display:flex; flex-wrap:wrap; gap:10px; margin-top:8px;">
                        @foreach($listing->images as $image)
                        <div style="position:relative;">
                            <img src="{{ asset($image->image_path) }}"
                                 style="width:100px; height:75px; object-fit:cover; border-radius:6px; border:1px solid var(--border);">
                            <label style="position:absolute; top:4px; right:4px; background:rgba(0,0,0,0.7); border-radius:4px; padding:2px 5px; cursor:pointer; display:flex; align-items:center; gap:4px; font-size:0.7rem; color:#fff;">
                                <input type="checkbox" name="remove_images[]" value="{{ $image->id }}"> Dzēst
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Jaunas bildes --}}
                <div class="filter-group full-width">
                    <label for="images">Pievienot jaunas bildes</label>
                    <input type="file" id="images" name="images[]" accept="image/*" multiple>
                    <div class="image-previews" id="preview-container"></div>
                </div>

                {{-- Marka & Modelis --}}
                <div class="filter-group">
                    <label for="brand">Marka *</label>
                    <select id="brand" name="brand" required>
                        <option value="">Izvēlies marku</option>
                        @foreach(['alfaromeo'=>'Alfa Romeo','audi'=>'Audi','bmw'=>'BMW','chevrolet'=>'Chevrolet','chrysler'=>'Chrysler','citroen'=>'Citroen','cupra'=>'Cupra','dacia'=>'Dacia','dodge'=>'Dodge','fiat'=>'Fiat','ford'=>'Ford','honda'=>'Honda','hyundai'=>'Hyundai','infiniti'=>'Infiniti','jaguar'=>'Jaguar','jeep'=>'Jeep','kia'=>'Kia','lancia'=>'Lancia','landrover'=>'Land Rover','lexus'=>'Lexus','mazda'=>'Mazda','mercedes'=>'Mercedes','mini'=>'Mini','mitsubishi'=>'Mitsubishi','nissan'=>'Nissan','opel'=>'Opel','peugeot'=>'Peugeot','porsche'=>'Porsche','renault'=>'Renault','saab'=>'Saab','seat'=>'Seat','skoda'=>'Skoda','smart'=>'Smart','subaru'=>'Subaru','suzuki'=>'Suzuki','tesla'=>'Tesla','toyota'=>'Toyota','volkswagen'=>'Volkswagen','volvo'=>'Volvo','gaz'=>'Gaz','uaz'=>'Uaz','vaz'=>'Vaz'] as $val => $label)
                            <option value="{{ $val }}" @selected($listing->brand === $val)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="model">Modelis *</label>
                    <select id="model" name="model" required>
                        <option value="{{ $listing->model }}" selected>{{ $listing->model }}</option>
                    </select>
                </div>

                {{-- Gads & Cena --}}
                <div class="filter-group">
                    <label for="year">Izlaiduma gads *</label>
                    <select name="year" id="year" required>
                        <option value="">Izvēlies gadu</option>
                        @for ($y = date('Y'); $y >= 1950; $y--)
                            <option value="{{ $y }}" @selected($listing->year == $y)>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div class="filter-group">
                    <label for="price">Cena (€) *</label>
                    <input type="number" id="price" name="price" value="{{ $listing->price }}" min="0" step="0.01" required>
                </div>

                {{-- Virsbūve & Degviela & Ātrumkārba --}}
                <div class="filter-group">
                    <label for="body_type">Virsbūves tips</label>
                    <select id="body_type" name="body_type">
                        <option value="">Izvēlies</option>
                        @foreach(['sedans'=>'Sedans','universalis'=>'Universālis','kupeja'=>'Kupeja','hecbeks'=>'Hečbeks','suv'=>'SUV','kabriolets'=>'Kabriolets','pikaps'=>'Pikaps','minivens'=>'Minivens'] as $v => $l)
                            <option value="{{ $v }}" @selected($listing->body_type === $v)>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="fuel_type">Degvielas tips</label>
                    <select id="fuel_type" name="fuel_type">
                        <option value="">Izvēlies</option>
                        @foreach(['elektrisks'=>'Elektrisks','benzins'=>'Benzīns','dizelis'=>'Dīzelis','benzins-gaze'=>'Benzīns + Gāze','hibrids'=>'Hibrīds'] as $v => $l)
                            <option value="{{ $v }}" @selected($listing->fuel_type === $v)>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label for="transmission">Ātrumkārba</label>
                    <select id="transmission" name="transmission">
                        <option value="">Izvēlies</option>
                        @foreach(['automats'=>'Automāts','manuals'=>'Manuāls','sequential'=>'Sequential'] as $v => $l)
                            <option value="{{ $v }}" @selected($listing->transmission === $v)>{{ $l }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tehniskie dati --}}
                <div class="filter-group">
                    <label for="engine_volume">Dzinēja tilpums (cm³)</label>
                    <input type="number" id="engine_volume" name="engine_volume" value="{{ $listing->engine_volume }}">
                </div>

                <div class="filter-group">
                    <label for="mileage">Nobraukums (km)</label>
                    <input type="number" id="mileage" name="mileage" value="{{ $listing->mileage }}">
                </div>

                <div class="filter-group">
                    <label for="color">Krāsa</label>
                    <input type="text" id="color" name="color" value="{{ $listing->color }}">
                </div>

                <div class="filter-group">
                    <label for="license_plate">Numurzīme</label>
                    <input type="text" id="license_plate" name="license_plate" value="{{ $listing->license_plate }}">
                </div>

                <div class="filter-group">
                    <label for="vin">VIN kods</label>
                    <input type="text" id="vin" name="vin" value="{{ $listing->vin }}">
                </div>

                <div class="filter-group">
                    <label for="next_inspection">Nākamā apskate</label>
                    <input type="date" id="next_inspection" name="next_inspection" value="{{ $listing->next_inspection }}">
                </div>

                {{-- Apskate --}}
                <div class="filter-group">
                    <label for="prev_inspection_rating">Iepriekšējās apskates vērtējums</label>
                    <select id="prev_inspection_rating" name="prev_inspection_rating">
                        <option value="">Izvēlies</option>
                        <option value="0" @selected($listing->prev_inspection_rating === 0)>0 — Viss kārtībā (bez defektiem)</option>
                        <option value="1" @selected($listing->prev_inspection_rating == 1)>1 — Sīks trūkums vai bojājums</option>
                        <option value="2" @selected($listing->prev_inspection_rating == 2)>2 — Būtisks trūkums vai bojājums</option>
                        <option value="3" @selected($listing->prev_inspection_rating == 3)>3 — Bīstams trūkums vai bojājums</option>
                    </select>
                </div>

                <div class="filter-group" id="problem-group" style="display: none;">
                    <label>Problēma</label>
                </div>

                {{-- Apraksts --}}
                <div class="filter-group full-width">
                    <label for="description">Apraksts</label>
                    <textarea id="description" name="description" rows="4">{{ $listing->description }}</textarea>
                </div>

                <div class="form-actions">
                    <button type="submit" class="button" id="submitBtn">Saglabāt izmaiņas</button>
                    <a href="{{ route('listing.show', $listing->id) }}" class="button btn-secondary">Atcelt</a>
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

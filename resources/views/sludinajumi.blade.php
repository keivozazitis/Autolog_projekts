<!-- resources/views/auth.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Login / Register</title>
    @vite(['resources/css/app.css', 'resources/js/modelis.js'])
</head>
<body>
    <header>
        <!--headeris-->
        <img src="autolog.png" alt="logo" width="150" height="120">
        <div class="header-text">
            <a href="/" style="text-decoration: none; color: inherit;">
                <h1>Autolog</h1>
            </a>
            <a href="/sludinajumi" class="header-nav-btn">SLUDINĀJUMI</a>
            @if(Auth::check())
            <a href="/addListing" class="header-nav-btn">IEVIETOT SLUDINĀJUMU</a>
            @endif
            @if(Auth::check())
            <a href="/katalogs" class="header-nav-btn">PRIVĀTAIS KATALOGS</a>
            @endif
            @if(!Auth::check())
            <a href="/registration" class="header-nav-btn">LOGIN</a>
            <a href="/registration" class="header-nav-btn">REGISTRATION</a>
            @endif
        </div>
        <a href="/profile" class="header-nav-btn profile-btn">
            @if(Auth::check())
            {{ Auth::user()->name }}
            @else
            PROFILS
            @endif
        </a>
        @if(Auth::check())
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="header-nav-btn" style="color: red;">Logout</button>
        </form>
        @endif
    </header> 
    <main>
        <!--visas marku opcijas-->
        <section class="Auto-markas">
            <form id="filter-form">
                <!-- Marka -->
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
                <div class="filter-group">
                    <label for="model">Modelis</label>
                    <select id="model" name="model" disabled>
                        <option value="">Vispirms izvēlies marku</option>
                    </select>
                </div>
                <!-- Gads -->
                <div class="filter-group">
                    <label for="year">Gads:</label>
                    <select name="year" id="year">
                        <option value="">Visi gadi</option>
                        <?php
                        $currentYear = date('Y');
                        for ($year = $currentYear; $year >= 1950; $year--) {
                            echo "<option value=\"$year\">$year</option>";
                        }
                        ?>
                    </select>
                </div>
        
                <!-- Cena: viena rinda ar diviem laukiem -->
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="price-from">Cena no (€):</label>
                        <input type="number" id="price-from" name="price-from" placeholder="0">
                    </div>

                    <div class="filter-group">
                        <label for="price-to">Cena līdz (€):</label>
                        <input type="number" id="price-to" name="price-to" placeholder="5000">
                    </div>
                </div>

        
                <!-- ✅ Virsbūves tips -->
                <div class="filter-group">
                    <label for="body-type">Virsbūves tips:</label>
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
        
                <!-- ✅ Degvielas tips -->
                <div class="filter-group">
                    <label for="fuel-type">Degvielas tips:</label>
                    <select id="fuel-type" name="fuel-type">
                        <option value="">Visi</option>
                        <option value="elektrisks">Elektrisks</option>
                        <option value="benzins">Benzīns</option>
                        <option value="dizelis">Dīzelis</option>
                        <option value="benzins-gaze">Benzīns + Gāze</option>
                        <option value="hibrids">Hibrīds</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="trans-type">Ātrumkārba:</label>
                    <select id="trans-type" name="trans-type">
                        <option value="">Visi</option>
                        <option value="Automats">Automats</option>
                        <option value="Manuals">Manuāls</option>
                        <option value="Sequential">Sequential</option>  
                    </select>
                </div>
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="engine-volume-from">Dzinēja tilpums no (cm³):</label>
                        <input type="number" id="engine-volume-from" name="engine-volume-from" placeholder="1000">
                    </div>

                    <div class="filter-group">
                        <label for="engine-volume-to">Dzinēja tilpums līdz (cm³):</label>
                        <input type="number" id="engine-volume-to" name="engine-volume-to" placeholder="2000">
                    </div>
                </div>

        
                <button type="submit" class="button">Rādīt</button>
            </form>
        </section>
        
                <section class="listings">
            @forelse ($listings as $listing)
                <div class="listing">
                    <h3>{{ $listing->brand }} {{ $listing->model }} ({{ $listing->year }})</h3>
                    <p>Cena: €{{ number_format($listing->price, 2) }}</p>
                    <p>Apraksts: {{ $listing->description }}</p>

                    <div class="images">
                        @foreach ($listing->images as $image)
                            <img src="{{ asset($image->image_path) }}" alt="Sludinājuma bilde" style="max-width: 300px; height: auto;">
                        @endforeach
                    </div>
                    
    
                        <form action="{{ route('listing.destroy', $listing->id) }}" method="POST" onsubmit="return confirm('Vai tiešām vēlies dzēst šo sludinājumu?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Dzēst sludinājumu</button>
                        </form>
                        <a href="{{ route('listing.show', $listing->id) }}">
                        <button type="button" class="btn btn-primary">Apskatīt sludinājumu</button>
                        </a>
                </div>
                <hr>
            @empty
                <p>Nav pieejamu sludinājumu.</p>
            @endforelse
        </section>
        
    </main>
</body>
<footer style="text-align: center; padding: 20px; background-color: #f1f1f1; color: #333; margin-top: 40px;">
    &copy; {{ date('Y') }} AutoLog. Visas tiesības aizsargātas.
</footer>
</html>

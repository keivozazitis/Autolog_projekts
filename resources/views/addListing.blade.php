<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Autolog | Ievietot sludinajumu</title>
    @vite(['resources/css/app.css', 'resources/js/modelis.js', 'resources/js/addlisting.js'])
</head>
<body>
    <section class="ievietot-sludinajumu">
        <form id="add-listing-form">
            <!-- Marka -->
            <div class="filter-group">
                <label for="brand">Marka</label>
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
    
            <!-- Modelis -->    
            <div class="filter-group">
                <label for="model">Modelis</label>
                <select id="model" name="model" disabled>
                    <option value="">Vispirms izvēlies marku</option>
                </select>
            </div>
    
            <!-- Gads -->
            <div class="filter-group">
                <label for="year">Izlaiduma gads:</label>
                <select name="year" id="year" required>
                    <option value="">Izvēlies gadu</option>
                    @for ($year = date('Y'); $year >= 1950; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
    
            <!-- Cena -->
            <div class="filter-group">
                <label for="price">Cena (€):</label>
                <input type="number" id="price" name="price" placeholder="Piem. 6500" min="0" step="0.01" required>
            </div>
    
            <!-- Virsbūves tips -->
            <div class="filter-group">
                <label for="body_type">Virsbūves tips:</label>
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
    
            <!-- Degvielas tips -->
            <div class="filter-group">
                <label for="fuel_type">Degvielas tips:</label>
                <select id="fuel_type" name="fuel_type">
                    <option value="">Izvēlies</option>
                    <option value="elektrisks">Elektrisks</option>
                    <option value="benzins">Benzīns</option>
                    <option value="dizelis">Dīzelis</option>
                    <option value="benzins-gaze">Benzīns + Gāze</option>
                    <option value="hibrids">Hibrīds</option>
                </select>
            </div>
    
            <!-- Ātrumkārba -->
            <div class="filter-group">
                <label for="transmission">Ātrumkārba:</label>
                <select id="transmission" name="transmission">
                    <option value="">Izvēlies</option>
                    <option value="automats">Automāts</option>
                    <option value="manuals">Manuāls</option>
                    <option value="sequential">Sequential</option>
                </select>
            </div>
    
            <!-- Dzinēja tilpums -->
            <div class="filter-row">
                <div class="filter-group">
                    <label for="engine_volume">Dzinēja tilpums (cm³):</label>
                    <input type="number" id="engine_volume" name="engine_volume" placeholder="Piem. 1600">
                </div>
            </div>
            <!-- Nobraukums -->
            <div class="filter-group">
                <label for="mileage">Nobraukums (km)</label>
                <input type="number" id="mileage" name="mileage" placeholder="100000">
            </div>

            <!-- Krāsa -->
            <div class="filter-group">
                <label for="color">Krāsa</label>
                <input type="text" id="color" name="color" placeholder="Piem. Melna">
            </div>

            <!-- Numurzīme -->
            <div class="filter-group">
                <label for="license_plate">Numurzīme</label>
                <input type="text" id="license_plate" name="license_plate" placeholder="ABC-1234">
            </div>

            <!-- VIN kods -->
            <div class="filter-group">
                <label for="vin">VIN kods</label>
                <input type="text" id="vin" name="vin" placeholder="1HGCM82633A004352">
            </div>

            <!-- Nākamā apskate -->
            <div class="filter-group">
                <label for="next_inspection">Nākamā apskate</label>
                <input type="date" id="next_inspection" name="next_inspection">
            </div>

            <!-- Apraksts -->
            <div class="filter-group" style="flex: 1 1 100%;">
                <label for="description">Apraksts</label>
                <textarea id="description" name="description" rows="3" placeholder="Papildus informācija..."></textarea>
            </div>

            <!-- Iepriekšējās apskates vērtējums -->
            <div class="filter-group">
                <label for="prev_inspection_rating">Iepriekšējās apskates vērtējums</label>
                <select id="prev_inspection_rating" name="prev_inspection_rating">
                    <option value="">Izvēlies</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="filter-group" id="problem-group" style="display: none;">
                <label for="prev_inspection_problem">Problēma</label>
                <select id="prev_inspection_problem" name="prev_inspection_problem">
                  <!-- Opcijas tiks pievienotas ar JS -->
                </select>
              </div>
        </div>

        <button type="submit" class="button">Ievietot sludinājumu</button>
        </form>
    </section>
    
</body>
</html>
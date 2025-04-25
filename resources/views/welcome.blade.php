<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoLog</title>
    <link rel="stylesheet" href="app.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/css/app.css','resources/js/toggle.js', 'public/autolog.png'])
</head>
<body>
    <header>
        <!--headeris-->
        <img src="autolog.png" alt="logo" width="150" height="120">
        <div class="header-text">
            <h1>Autolog</h1>
            <a href="">SLUDINĀJUMI</a>
            <a href="/registration">LOGIN</a>
            <a href="/registration">REGISTRATION</a>
        </div>
        <!--darkmode switch-->
        <div class="mode">
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider"></span>
            </label>
        </div>
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
                        <!-- [.. tavas esošās markas ..] -->
                        <option value="citas markas">Citas markas</option>
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
        
    </main>
    
</body>
</html>
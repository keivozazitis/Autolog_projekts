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
        <img src="autolog.png" alt="logo" width="150" height="120">
        <div class="header-text">
            <h1>Autolog</h1>
            <a href="">SLUDINĀJUMI</a>
            <a href="/registration">LOGIN</a>
            <a href="/registration">REGISTRATION</a>
        </div>
        <div class="mode">
            <label class="switch">
                <input type="checkbox" id="theme-toggle">
                <span class="slider"></span>
            </label>
        </div>
    </header> 
    <main>
        <section class="filter-section">
            <form id="filter-form">
                <div class="filter-group">
                    <label for="brand">Marka</label>
                    <select id="brand" name="brand">
                        <option value="">Visi</option>
                        <option value="bmw">BMW</option>
                        <option value="audi">Audi</option>
                        <option value="volvo">Volvo</option>
                    </select>
                </div>
        
                <div class="filter-group">
                    <label for="year">Gads:</label>
                    <select id="year" name="year">
                        <option value="">Visi</option>
                        <option value="2020">2020+</option>
                        <option value="2015">2015+</option>
                        <option value="2010">2010+</option>
                    </select>
                </div>
        
                <div class="filter-group">
                    <label for="price">Cena līdz (€):</label>
                    <input type="number" id="price" name="price" placeholder="5000">
                </div>
        
                <button type="submit" class="button">Filtrēt</button>
            </form>
        </section>
        
    </main>
    
</body>
</html>
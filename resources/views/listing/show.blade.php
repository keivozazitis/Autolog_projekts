<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $listing->brand }} {{ $listing->model }} - Sludinājums</title>
    @vite(['resources/css/app.css', 'resources/js/modelis.js', 'resources/js/addlisting.js'])
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: rgb(150, 150, 150);
            color: black;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        header {
            background-color: rgb(150, 150, 150);
            color: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        header img {
            margin-right: 20px;
            height: auto;
        }
        
        .header-text {
            display: flex;
            align-items: center;
            flex-grow: 1;
        }
        
        .header-text h1 {
            margin: 0 30px 0 0;
            color: #000000;
            font-size: 28px;
        }
        
        .header-nav-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #7c7c7c;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            margin: 0 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .header-nav-btn:hover {
            background-color: #6b6b6b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            text-decoration: none;
        }
        
        .profile-btn {
            background-color: #6b6b6b;
            margin-left: 200px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
        }
        
        .listing-header {
            background-color: rgb(196, 196, 196);
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 6px 10px 0 rgb(0, 0, 0);
        }
        
        .listing-title {
            font-size: 2rem;
            margin: 0 0 10px;
            color: #000000;
        }
        
        .price-tag {
            display: inline-block;
            background-color: #7c7c7c;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 10px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .details-card {
            background-color: rgb(196, 196, 196);
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 6px 10px 0 rgb(0, 0, 0);
        }
        
        .details-title {
            font-size: 1.25rem;
            margin-top: 0;
            margin-bottom: 15px;
            color: #000000;
            border-bottom: 1px solid rgb(150, 150, 150);
            padding-bottom: 8px;
        }
        
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .gallery img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 6px 10px 0 rgb(0, 0, 0);
            transition: transform 0.3s ease;
            background-color: white;
            padding: 5px;
        }
        
        .gallery img:hover {
            transform: scale(2.02);
            box-shadow: 0 10px 16px 0 rgb(0, 0, 0);
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            background-color: #7c7c7c;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            font-weight: 600;
        }
        
        .filter-group {
            margin-bottom: 15px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .filter-group select,
        .filter-group input,
        .filter-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #aaa;
            border-radius: 5px;
            background-color: white;
        }
        
        .filter-row {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }
        
        .filter-row .filter-group {
            flex: 1;
            min-width: 150px;
        }
        
        .inspection-rating {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .rating-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .rating-1 { background-color: #ff6b6b; color: white; }
        .rating-2 { background-color: #ffd166; color: black; }
        .rating-3 { background-color: #06d6a0; color: white; }
        
        .rating-circle.active {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        
        @media (max-width: 768px) {
            .listing-title {
                font-size: 1.5rem;
            }
            
            .price-tag {
                font-size: 1.25rem;
            }
            
            .container {
                padding: 15px;
            }
            
            .listing-header {
                padding: 20px;
            }
            
            .gallery {
                grid-template-columns: 1fr;
            }
            
            header {
                flex-direction: column;
                padding: 10px;
            }
            
            .header-text {
                flex-direction: column;
                align-items: center;
                margin-top: 15px;
            }
            
            .header-nav-btn {
                margin: 5px 0;
                width: 100%;
                text-align: center;
            }
            
            .profile-btn {
                margin-left: 0;
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <img src="../autolog.png" alt="logo" width="150" height="120">
        <div class="header-text">
            <a href="/" style="text-decoration: none; color: inherit;">
                <h1>Autolog</h1>
            </a>
            <a href="/sludinajumi" class="header-nav-btn">SLUDINĀJUMI</a>
            @if(Auth::check())
            <a href="/addListing" class="header-nav-btn">IEVIETOT SLUDINĀJUMU</a>
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

    <div class="container">
        <div class="listing-header">
            <h1 class="listing-title">{{ $listing->brand }} {{ $listing->model }} <span class="year">({{ $listing->year }})</span></h1>
            <div class="price-tag">€{{ number_format($listing->price, 2) }}</div>
        </div>
        
        <div class="details-card">
            <h2 class="details-title">Pamatinformācija</h2>
            <div class="filter-row">
                <div class="filter-group">
                    <label>Marka</label>
                    <p>{{ $listing->brand }}</p>
                </div>
                <div class="filter-group">
                    <label>Modelis</label>
                    <p>{{ $listing->model }}</p>
                </div>
                <div class="filter-group">
                    <label>Gads</label>
                    <p>{{ $listing->year }}</p>
                </div>
            </div>
            
            <div class="filter-row">
                <div class="filter-group">
                    <label>Virsbūves tips</label>
                    <p>{{ $listing->body_type }}</p>
                </div>
                <div class="filter-group">
                    <label>Degvielas tips</label>
                    <p>{{ $listing->fuel_type }}</p>
                </div>
                <div class="filter-group">
                    <label>Ātrumkārba</label>
                    <p>{{ $listing->transmission }}</p>
                </div>
            </div>
            
            <div class="filter-row">
                <div class="filter-group">
                    <label>Dzinēja tilpums</label>
                    <p>{{ $listing->engine_volume }} cm³</p>
                </div>
                <div class="filter-group">
                    <label>Nobraukums</label>
                    <p>{{ $listing->mileage }} km</p>
                </div>
                <div class="filter-group">
                    <label>Krāsa</label>
                    <p>{{ $listing->color }}</p>
                </div>
            </div>
            
            <div class="filter-row">
                <div class="filter-group">
                    <label>Numurzīme</label>
                    <p>{{ $listing->license_plate }}</p>
                </div>
                <div class="filter-group">
                    <label>VIN kods</label>
                    <p>{{ $listing->vin }}</p>
                </div>
                <div class="filter-group">
                    <label>Nākamā apskate</label>
                    <p>{{ $listing->next_inspection }}</p>
                </div>
            </div>
        </div>
        
        <div class="details-card">
            <h2 class="details-title">Apraksts</h2>
            <p>{{ $listing->description }}</p>
        </div>
        
        <div class="details-card">
            <h2 class="details-title">Galerija</h2>
            <div class="gallery">
                @foreach ($listing->images as $image)
                    <img src="{{ asset($image->image_path) }}" alt="{{ $listing->brand }} {{ $listing->model }}">
                @endforeach
            </div>
        </div>
        
        <div class="details-card">
            <h2 class="details-title">Tehniskā apskate</h2>
            <div class="filter-row">
                <div class="filter-group">
                    <label>Iepriekšējās apskates vērtējums</label>
                    @if($listing->prev_inspection_rating)
                        <div class="inspection-rating">
                            <div class="rating-circle rating-{{ $listing->prev_inspection_rating }} active">
                                {{ $listing->prev_inspection_rating }}
                            </div>
                            <span>
                                @if($listing->prev_inspection_rating == 1) Nepieciešams remonts
                                @elseif($listing->prev_inspection_rating == 2) Nelielas nepilnības
                                @elseif($listing->prev_inspection_rating == 3) Nav konstatētas nepilnības
                                @endif
                            </span>
                        </div>
                    @else
                        <p>Nav norādīts</p>
                    @endif
                </div>
                
                @if($listing->prev_inspection_problem)
                <div class="filter-group">
                    <label>Konstatētās nepilnības</label>
                    <p>{{ $listing->prev_inspection_problem }}</p>
                </div>
                @endif
            </div>
        </div>
        
        <a href="{{ url()->previous() }}" class="back-button">Atpakaļ</a>
    </div>
</body>
</html>
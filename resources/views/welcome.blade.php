@extends('layouts.app')

@section('title', 'AutoLog — Latvijas Automašīnu Tirgus')

@section('content')
<section class="hero-section">
    <div class="hero-bg-grid"></div>
    <div class="hero-content">
        <h1 class="hero-title">
            Tavs nākamais<br><span class="hero-title-accent">auto ir šeit</span>
        </h1>
        <p class="hero-subtitle">
            Pārdod ātri. Pērc droši. Viss vienā vietā.
        </p>
        <div class="hero-stats">
            <div class="hero-stat">
                <span class="hero-stat-number">{{ number_format($listingCount) }}</span>
                <span class="hero-stat-label">Sludinājumi</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <span class="hero-stat-number">{{ $todayCount }}</span>
                <span class="hero-stat-label">Šodienas sludinājumi</span>
            </div>
            <div class="hero-stat-divider"></div>
            <div class="hero-stat">
                <span class="hero-stat-number">{{ $brandCount }}</span>
                <span class="hero-stat-label">Markas</span>
            </div>
        </div>
    </div>

    {{-- ── Ātrā meklēšana ── --}}
    <div class="quick-search-box">
        <form action="/sludinajumi" method="GET" class="quick-search-form">
            <div class="qs-field">
                <label for="qs-brand">Marka</label>
                <select id="qs-brand" name="brand">
                    <option value="">Visas markas</option>
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

            <div class="qs-field qs-price-group">
                <label>Cena (€)</label>
                <div class="qs-range">
                    <input type="number" name="price-from" placeholder="No" min="0">
                    <span class="qs-range-sep">—</span>
                    <input type="number" name="price-to" placeholder="Līdz" min="0">
                </div>
            </div>

            <div class="qs-field">
                <label for="qs-year">Gads</label>
                <select id="qs-year" name="year">
                    <option value="">Visi gadi</option>
                    @for ($y = date('Y'); $y >= 1990; $y--)
                        <option value="{{ $y }}">{{ $y }}</option>
                    @endfor
                </select>
            </div>

            <button type="submit" class="qs-submit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                Meklēt
            </button>
        </form>
    </div>

    {{-- ── Populārās markas ── --}}
    <div style="position:relative; z-index:1; width:100%; max-width:960px; margin-top:48px;">
        <p style="text-align:center; font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:var(--text-muted); margin-bottom:16px;">
            Populārās markas
        </p>
        <div class="brand-cards">
            <a href="/sludinajumi?brand=bmw" class="brand-logo-card">
                <div class="brand-logo-img-wrap">
                    <img src="{{ asset('logos/bmw.svg') }}" alt="BMW">
                </div>
                <span class="brand-logo-name">BMW</span>
            </a>
            <a href="/sludinajumi?brand=audi" class="brand-logo-card">
                <div class="brand-logo-img-wrap">
                    <img src="{{ asset('logos/audi.svg') }}" alt="Audi">
                </div>
                <span class="brand-logo-name">Audi</span>
            </a>
            <a href="/sludinajumi?brand=volkswagen" class="brand-logo-card">
                <div class="brand-logo-img-wrap">
                    <img src="{{ asset('logos/vw.svg') }}" alt="Volkswagen">
                </div>
                <span class="brand-logo-name">Volkswagen</span>
            </a>
        </div>
    </div>

</section>
@endsection

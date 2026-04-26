@extends('layouts.app')

@section('title', 'AutoPlacis — Premium Abonements')

@section('content')
<div class="upgrade-page">

    @if(session('limit'))
        <div class="upgrade-alert">{{ session('limit') }}</div>
    @endif

    <div class="upgrade-card">
        <div class="upgrade-badge">Premium</div>

        <h1 class="upgrade-title">AutoPlacis</h1>
        <p class="upgrade-subtitle">Neierobežoti sludinājumi. Viss vienā vietā.</p>

        <div class="upgrade-price">
            <span class="upgrade-price-amount">€30</span>
            <span class="upgrade-price-period">/mēnesī</span>
        </div>

        <ul class="upgrade-features">
            <li>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                Neierobežoti sludinājumi
            </li>
            <li>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                Neierobežots privātais katalogs
            </li>
            <li>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                Atcelt jebkurā laikā
            </li>
        </ul>

        <a href="{{ route('subscription.checkout') }}" class="upgrade-btn">
            Abonēt tagad
        </a>

        <p class="upgrade-note">Droša maksājuma apstrāde ar Stripe</p>
    </div>
</div>

<style>
.upgrade-page {
    max-width: 480px;
    margin: 64px auto;
    padding: 0 24px;
}

.upgrade-alert {
    background: rgba(201, 167, 112, 0.08);
    border: 1px solid rgba(201, 167, 112, 0.3);
    color: var(--accent);
    padding: 12px 16px;
    border-radius: var(--radius-sm);
    font-size: 0.875rem;
    margin-bottom: 24px;
    text-align: center;
}

.upgrade-card {
    background: var(--bg-card);
    border: 1px solid rgba(201, 167, 112, 0.2);
    border-radius: var(--radius);
    padding: 48px 40px;
    text-align: center;
    box-shadow: 0 0 60px rgba(201, 167, 112, 0.06);
}

.upgrade-badge {
    display: inline-block;
    background: rgba(201, 167, 112, 0.1);
    border: 1px solid rgba(201, 167, 112, 0.3);
    color: var(--accent);
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    padding: 4px 14px;
    border-radius: 999px;
    margin-bottom: 20px;
}

.upgrade-title {
    font-size: 2.2rem;
    font-weight: 300;
    color: var(--text-primary);
    margin: 0 0 8px;
    letter-spacing: -1px;
}

.upgrade-subtitle {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin: 0 0 32px;
}

.upgrade-price {
    margin-bottom: 32px;
}

.upgrade-price-amount {
    font-size: 3.5rem;
    font-weight: 300;
    color: var(--accent);
    letter-spacing: -2px;
}

.upgrade-price-period {
    font-size: 1rem;
    color: var(--text-muted);
    margin-left: 4px;
}

.upgrade-features {
    list-style: none;
    padding: 0;
    margin: 0 0 36px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    text-align: left;
}

.upgrade-features li {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.upgrade-features li svg {
    color: var(--accent);
    flex-shrink: 0;
}

.upgrade-btn {
    display: block;
    width: 100%;
    padding: 14px;
    background: var(--accent);
    color: #111;
    border-radius: var(--radius-sm);
    font-size: 0.95rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.18s ease;
    margin-bottom: 16px;
}

.upgrade-btn:hover {
    background: var(--accent-hover);
    transform: translateY(-1px);
    box-shadow: 0 4px 20px rgba(201, 167, 112, 0.3);
}

.upgrade-note {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin: 0;
}
</style>
@endsection

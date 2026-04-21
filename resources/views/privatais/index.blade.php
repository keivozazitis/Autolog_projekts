@extends('layouts.app')

@section('title', 'Mans katalogs — AutoLog')

@section('content')
<div class="listings-page">

    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:28px;">
        <h1 class="page-heading" style="margin:0;">Mans privātais katalogs</h1>
        <a href="{{ route('privatais.create') }}" class="button">+ Pievienot auto</a>
    </div>

    <div class="listings-grid">
        @forelse($ieraksti as $ieraksts)
            <div class="listing-card">
                <div class="listing-card-thumb">
                    @if(isset($ieraksts->images) && $ieraksts->images->first())
                        <img src="{{ asset($ieraksts->images->first()->image_path) }}"
                             alt="{{ $ieraksts->brand }} {{ $ieraksts->model }}">
                    @else
                        <div class="listing-card-no-image">Nav attēla</div>
                    @endif
                </div>

                <div class="listing-card-body">
                    <h3 class="listing-card-title">
                        {{ $ieraksts->brand }} {{ $ieraksts->model }}
                        <span class="listing-card-year">({{ $ieraksts->year }})</span>
                    </h3>
                    <div class="listing-card-price">€{{ number_format($ieraksts->price, 2) }}</div>

                    @if(isset($ieraksts->fuel_type) || isset($ieraksts->mileage))
                    <div style="display:flex; gap:8px; flex-wrap:wrap; margin-bottom:14px;">
                        @if($ieraksts->fuel_type)
                            <span style="font-size:0.75rem; padding:3px 10px; background:var(--bg-elevated); border:1px solid var(--border); border-radius:999px; color:var(--text-secondary);">
                                {{ $ieraksts->fuel_type }}
                            </span>
                        @endif
                        @if($ieraksts->mileage)
                            <span style="font-size:0.75rem; padding:3px 10px; background:var(--bg-elevated); border:1px solid var(--border); border-radius:999px; color:var(--text-secondary);">
                                {{ number_format($ieraksts->mileage) }} km
                            </span>
                        @endif
                    </div>
                    @endif

                    <div class="listing-card-actions">
                        <a href="{{ route('privatais.show', $ieraksts->id) }}" style="flex:1;">
                            <button type="button" class="button btn-secondary" style="width:100%;">Apskatīt detaļas</button>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state" style="grid-column:1/-1;">
                <p style="color:var(--text-muted); font-size:1rem; margin-bottom:16px;">Tavs katalogs ir tukšs.</p>
                <a href="{{ route('privatais.create') }}" class="button">Pievienot pirmo auto</a>
            </div>
        @endforelse
    </div>

</div>
@endsection

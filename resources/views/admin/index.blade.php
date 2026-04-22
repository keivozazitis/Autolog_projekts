@extends('layouts.app')

@section('title', 'Admin — AutoLog')

@section('content')
<div class="listings-page">

    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:28px;">
        <h1 class="page-heading" style="margin:0;">Admin panelis</h1>
        <span style="font-size:0.8rem; color:var(--text-muted);">{{ $listings->count() }} sludinājumi · {{ $users->count() }} lietotāji</span>
    </div>

    @if(session('success'))
        <div style="background:rgba(40,167,69,0.12); border:1px solid rgba(40,167,69,0.3); color:#5cb85c; padding:12px 16px; border-radius:var(--radius-sm); margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Sludinājumu saraksts --}}
    <div class="details-card" style="padding:0; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
            <thead>
                <tr style="background:var(--bg-elevated); border-bottom:1px solid var(--border);">
                    <th style="padding:12px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">ID</th>
                    <th style="padding:12px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Auto</th>
                    <th style="padding:12px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Cena</th>
                    <th style="padding:12px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Lietotājs</th>
                    <th style="padding:12px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Datums</th>
                    <th style="padding:12px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($listings as $listing)
                <tr style="border-bottom:1px solid var(--border); transition:background 0.15s;"
                    onmouseover="this.style.background='var(--bg-elevated)'"
                    onmouseout="this.style.background='transparent'">
                    <td style="padding:12px 16px; color:var(--text-muted);">#{{ $listing->id }}</td>
                    <td style="padding:12px 16px;">
                        <a href="{{ route('listing.show', $listing->id) }}"
                           style="color:var(--text-primary); text-decoration:none; font-weight:500;"
                           target="_blank">
                            {{ $listing->brand }} {{ $listing->model }}
                            <span style="color:var(--text-muted); font-weight:400;">({{ $listing->year }})</span>
                        </a>
                    </td>
                    <td style="padding:12px 16px; color:var(--accent);">€{{ number_format($listing->price, 2) }}</td>
                    <td style="padding:12px 16px; color:var(--text-secondary);">
                        {{ $listing->user?->name ?? '—' }}
                    </td>
                    <td style="padding:12px 16px; color:var(--text-muted); font-size:0.8rem;">
                        {{ $listing->created_at->format('d.m.Y') }}
                    </td>
                    <td style="padding:12px 16px;">
                        <form action="{{ route('admin.listings.destroy', $listing->id) }}" method="POST"
                              onsubmit="return confirm('Dzēst šo sludinājumu?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    style="background:transparent; border:1px solid #c0392b; color:#e74c3c; padding:4px 12px; border-radius:var(--radius-sm); cursor:pointer; font-size:0.8rem; transition:background 0.15s;"
                                    onmouseover="this.style.background='rgba(231,76,60,0.12)'"
                                    onmouseout="this.style.background='transparent'">
                                Dzēst
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:32px 16px; text-align:center; color:var(--text-muted);">Nav sludinājumu.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($listings->hasPages())
    <div class="pagination-wrap">{{ $listings->links() }}</div>
    @endif

</div>
@endsection

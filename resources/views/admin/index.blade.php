@extends('layouts.app')
@section('title', 'Admin — AutoLog')
@section('content')
<div class="listings-page">

    <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px; margin-bottom:28px;">
        <h1 class="page-heading" style="margin:0;">Admin panelis</h1>
    </div>

    @if(session('success'))
        <div style="background:rgba(40,167,69,0.12); border:1px solid rgba(40,167,69,0.3); color:#5cb85c; padding:12px 16px; border-radius:var(--radius-sm); margin-bottom:20px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Statistika --}}
    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(160px,1fr)); gap:12px; margin-bottom:32px;">
        <div class="details-card" style="padding:20px; text-align:center;">
            <div style="font-size:2rem; font-weight:300; color:var(--text-primary);">{{ $stats['total_users'] }}</div>
            <div style="font-size:0.72rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.07em;">Lietotāji</div>
            <div style="font-size:0.75rem; color:var(--accent); margin-top:4px;">+{{ $stats['new_users_today'] }} šodien</div>
        </div>
        <div class="details-card" style="padding:20px; text-align:center;">
            <div style="font-size:2rem; font-weight:300; color:var(--text-primary);">{{ $stats['total_listings'] }}</div>
            <div style="font-size:0.72rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.07em;">Sludinājumi</div>
            <div style="font-size:0.75rem; color:var(--accent); margin-top:4px;">+{{ $stats['listings_today'] }} šodien</div>
        </div>
        <div class="details-card" style="padding:20px; text-align:center;">
            <div style="font-size:2rem; font-weight:300; color:var(--text-primary);">{{ $stats['total_messages'] }}</div>
            <div style="font-size:0.72rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.07em;">Ziņas</div>
        </div>
        <div class="details-card" style="padding:20px; text-align:center; border-color:rgba(201,167,112,0.2);">
            <div style="font-size:2rem; font-weight:300; color:var(--accent);">{{ $stats['subscribed_users'] }}</div>
            <div style="font-size:0.72rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.07em;">AutoPlacis</div>
            <div style="font-size:0.75rem; color:var(--accent); margin-top:4px;">€{{ $stats['monthly_revenue'] }}/mēn</div>
        </div>
    </div>

    {{-- Lietotāji --}}
    <h2 style="font-size:1rem; font-weight:600; color:var(--text-primary); margin:0 0 12px;">Lietotāji</h2>
    <div class="details-card" style="padding:0; overflow:hidden; margin-bottom:32px;">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
            <thead>
                <tr style="background:var(--bg-elevated); border-bottom:1px solid var(--border);">
                    <th style="padding:10px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Lietotājs</th>
                    <th style="padding:10px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">E-pasts</th>
                    <th style="padding:10px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Sludinājumi</th>
                    <th style="padding:10px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Plāns</th>
                    <th style="padding:10px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Reģ. datums</th>
                    <th style="padding:10px 16px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr style="border-bottom:1px solid var(--border); transition:background 0.15s;"
                    onmouseover="this.style.background='var(--bg-elevated)'"
                    onmouseout="this.style.background='transparent'">
                    <td style="padding:10px 16px;">
                        <div style="display:flex; align-items:center; gap:8px;">
                            <div style="width:28px; height:28px; border-radius:50%; background:var(--accent); display:flex; align-items:center; justify-content:center; font-size:0.75rem; font-weight:700; color:#111; flex-shrink:0;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <span style="color:var(--text-primary); font-weight:500;">{{ $user->name }}</span>
                            @if($user->is_admin)
                                <span style="font-size:0.65rem; background:rgba(201,167,112,0.15); color:var(--accent); padding:2px 6px; border-radius:4px;">Admin</span>
                            @endif
                        </div>
                    </td>
                    <td style="padding:10px 16px; color:var(--text-secondary);">{{ $user->email }}</td>
                    <td style="padding:10px 16px; color:var(--text-secondary);">{{ $user->listings_count }}</td>
                    <td style="padding:10px 16px;">
                        @if($user->subscribed('default'))
                            <span style="font-size:0.75rem; background:rgba(201,167,112,0.1); border:1px solid rgba(201,167,112,0.3); color:var(--accent); padding:2px 8px; border-radius:999px;">★ AutoPlacis</span>
                        @else
                            <span style="font-size:0.75rem; color:var(--text-muted);">Bezmaksas</span>
                        @endif
                    </td>
                    <td style="padding:10px 16px; color:var(--text-muted); font-size:0.8rem;">{{ $user->created_at->format('d.m.Y') }}</td>
                    <td style="padding:10px 16px;">
                        @if(!$user->is_admin)
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                              onsubmit="return confirm('Dzēst lietotāju {{ $user->name }} un visus viņa datus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="background:transparent; border:1px solid #c0392b; color:#e74c3c; padding:4px 12px; border-radius:var(--radius-sm); cursor:pointer; font-size:0.8rem; transition:background 0.15s;"
                                onmouseover="this.style.background='rgba(231,76,60,0.12)'"
                                onmouseout="this.style.background='transparent'">
                                Dzēst
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Sludinājumi --}}
    <h2 style="font-size:1rem; font-weight:600; color:var(--text-primary); margin:0 0 12px;">Sludinājumi</h2>
    <div class="details-card" style="padding:0; overflow:hidden;">
        <table style="width:100%; border-collapse:collapse; font-size:0.875rem;">
            <thead>
                <tr style="background:var(--bg-elevated); border-bottom:1px solid var(--border);">
                    <th style="padding:10px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">ID</th>
                    <th style="padding:10px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Auto</th>
                    <th style="padding:10px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Cena</th>
                    <th style="padding:10px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Lietotājs</th>
                    <th style="padding:10px 16px; text-align:left; color:var(--text-muted); font-weight:600; text-transform:uppercase; font-size:0.7rem; letter-spacing:0.05em;">Datums</th>
                    <th style="padding:10px 16px;"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($listings as $listing)
                <tr style="border-bottom:1px solid var(--border); transition:background 0.15s;"
                    onmouseover="this.style.background='var(--bg-elevated)'"
                    onmouseout="this.style.background='transparent'">
                    <td style="padding:10px 16px; color:var(--text-muted);">#{{ $listing->id }}</td>
                    <td style="padding:10px 16px;">
                        <a href="{{ route('listing.show', $listing->id) }}" style="color:var(--text-primary); text-decoration:none; font-weight:500;" target="_blank">
                            {{ $listing->brand }} {{ $listing->model }}
                            <span style="color:var(--text-muted); font-weight:400;">({{ $listing->year }})</span>
                        </a>
                    </td>
                    <td style="padding:10px 16px; color:var(--accent);">€{{ number_format($listing->price, 0) }}</td>
                    <td style="padding:10px 16px; color:var(--text-secondary);">{{ $listing->user?->name ?? '—' }}</td>
                    <td style="padding:10px 16px; color:var(--text-muted); font-size:0.8rem;">{{ $listing->created_at->format('d.m.Y') }}</td>
                    <td style="padding:10px 16px;">
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

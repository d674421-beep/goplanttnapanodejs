@extends('admin.layouts.app')

@section('content')

<h1 class="page-title">Dashboard Admin</h1>

<div class="dashboard-grid">

    {{-- Total Tanaman --}}
    <div class="dashboard-card stat-green">
        <div class="stat-icon">🌿</div>
        <div class="stat-info">
            <h3>Total Tanaman</h3>
            <p>{{ $totalPlants }}</p>
        </div>
    </div>

    {{-- Posting Forum --}}
    <div class="dashboard-card stat-blue">
        <div class="stat-icon">💬</div>
        <div class="stat-info">
            <h3>Posting Forum</h3>
            <p>{{ $totalForums }}</p>
        </div>
    </div>

    {{-- Pengguna --}}
    <div class="dashboard-card stat-yellow">
        <div class="stat-icon">👥</div>
        <div class="stat-info">
            <h3>Pengguna</h3>
            <p>{{ $totalUsers }}</p>
        </div>
    </div>

</div>

@endsection

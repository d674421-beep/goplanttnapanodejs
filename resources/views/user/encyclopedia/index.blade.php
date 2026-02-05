@extends('user.layouts.app')

@section('content')
<div class="card">
    <h1 class="text-xl font-bold mb-4">Ensiklopedia Tanaman</h1>

    {{-- FILTER BAR (SAMA DENGAN ADMIN) --}}
    <form method="GET"
          action="{{ route('user.encyclopedia.index') }}"
          class="filter-bar">

        {{-- Search --}}
        <input type="text"
               name="q"
               value="{{ request('q') }}"
               placeholder="Cari judul atau isi...">

        {{-- Sort --}}
        <select name="sort">
            <option value="latest" {{ request('sort','latest') == 'latest' ? 'selected' : '' }}>
                Tanggal (Terbaru)
            </option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                Tanggal (Terlama)
            </option>
            <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>
                Judul (A–Z)
            </option>
            <option value="za" {{ request('sort') == 'za' ? 'selected' : '' }}>
                Judul (Z–A)
            </option>
        </select>

        <button type="submit" class="btn btn-sort">
            Terapkan
        </button>

        <a href="{{ route('user.encyclopedia.index') }}"
           class="btn btn-secondary">
            Reset
        </a>
    </form>

    {{-- LIST --}}
    @if($data->isEmpty())
        <p class="text-muted">Belum ada data.</p>
    @else
        @foreach ($data as $item)
            <div class="card item-card">

                <h3 class="text-lg font-semibold mb-2">
                    {{ $item->title }}
                </h3>

                {{-- Gambar --}}
                @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}"
                         class="item-image">
                @endif

                {{-- Ringkasan --}}
                <p class="item-content text-muted">
                    {{ \Illuminate\Support\Str::limit($item->content, 200) }}
                </p>

                {{-- AKSI USER --}}
                <div class="action-buttons">
                    <a href="{{ route('user.encyclopedia.show', $item) }}"
                       class="btn btn-view">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection

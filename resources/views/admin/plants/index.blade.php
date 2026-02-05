@extends('admin.layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-4">Data Tanaman</h1>

<a href="{{ route('admin.plants.create') }}"
   class="bg-green-600 text-white px-4 py-2 rounded">
   Tambah Tanaman
</a>

<table class="mt-4 w-full bg-white shadow rounded">
    <tr class="bg-gray-200">
        <th class="p-2">No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>

    @foreach ($plants as $plant)
    <tr class="border-t">
        <td class="p-2">{{ $loop->iteration }}</td>
        <td>{{ $plant->name }}</td>
        <td>
            <a href="{{ route('admin.plants.edit', $plant->id) }}" class="text-blue-600">Edit</a>

            <form method="POST" action="{{ route('admin.plants.destroy', $plant->id) }}" class="inline">
                @csrf @method('DELETE')
                <button class="text-red-600">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection

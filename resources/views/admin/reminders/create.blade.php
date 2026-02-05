@extends('admin.layouts.app')

@section('content')

<h1 class="mb-4">Tambah Pengingat</h1>

<form action="{{ route('admin.reminders.store') }}" method="POST">

    @include('admin.reminders._form')

    <div style="margin-top:15px">
        <button type="submit" class="btn-primary">
            Simpan
        </button>

        <a href="{{ route('admin.reminders.index') }}" class="btn-secondary">
            Batal
        </a>
    </div>

</form>

@endsection

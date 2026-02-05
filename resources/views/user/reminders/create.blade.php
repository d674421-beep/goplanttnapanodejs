@extends('user.layouts.app')

@section('content')
<h1 class="mb-4">Tambah Pengingat</h1>

<form action="{{ route('user.reminders.store') }}" method="POST">

    @include('user.reminders._form')

    <div style="margin-top:15px">
        <button type="submit" class="btn-primary">
            Simpan
        </button>

        <a href="{{ route('user.reminders.index') }}"
           class="btn-secondary">
            Batal
        </a>
    </div>

</form>
@endsection

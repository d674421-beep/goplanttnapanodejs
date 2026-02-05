@extends('admin.layouts.app')

@section('content')
<div class="card">
    <h1 class="text-xl font-bold mb-4">{{ $post->title }}</h1>

    <p><strong>Kategori:</strong> {{ ucfirst($post->category) }}</p>
    <p><strong>Tanggal:</strong> {{ $post->created_at->format('d M Y') }}</p>

    @if($post->image)
        <img src="{{ asset('storage/'.$post->image) }}"
             style="max-width:500px; margin:20px 0;">
    @endif

    <div>
        {!! nl2br(e($post->content)) !!}
    </div>
	<hr>

	<h2 class="text-lg font-bold mt-6 mb-4">Komentar</h2>

	@if($post->comments->isEmpty())
		<p>Belum ada komentar.</p>
	@else
		@include('admin.comments.post._item', [
			'comments' => $comments
		])

	@endif
	
	<hr>

	<h2 class="text-lg font-bold mt-6 mb-3">Tambah Komentar</h2>

	<form method="POST"
		  action="{{ route('admin.posts.comments.store', $post) }}"
		  style="margin-bottom:30px;">

		@csrf

		<textarea name="comment"
				  rows="4"
				  required
				  placeholder="Tulis komentar Anda..."
				  style="width:100%; padding:10px;"></textarea>

		<div style="margin-top: 10px;">
            <button type="submit" class="btn-primary">Kirim</button>

            <button type="reset" class="btn-secondary" style="margin-left:6px;">
				Hapus
			</button>

        </div>
	</form>


    <a href="{{ route('admin.posts.index') }}"
       class="btn-secondary"
       style="margin-top:20px; display:inline-block;">
        Kembali
    </a>
	
</div>
@endsection

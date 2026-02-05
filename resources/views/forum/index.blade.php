@foreach ($forums as $forum)
    <hr>
    <h3>{{ $forum->judul }}</h3>
    <p>{{ $forum->isi }}</p>

    <h4>Komentar:</h4>

    @foreach ($forum->comments as $comment)
        <p>
            {{ $comment->isi }}

            @if ($comment->user_id == auth()->id())
                <a href="/comment/{{ $comment->id }}/edit">Edit</a>

                <form method="POST" action="/comment/{{ $comment->id }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            @endif
        </p>
    @endforeach

    <form method="POST" action="/forum/{{ $forum->id }}/comment">
        @csrf
        <textarea name="isi" placeholder="Tulis komentar"></textarea><br>
        <button type="submit">Kirim</button>
    </form>
@endforeach

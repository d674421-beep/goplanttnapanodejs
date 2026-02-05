<h1>Edit Komentar</h1>

<form method="POST" action="/comment/{{ $comment->id }}">
    @csrf
    @method('PUT')

    <textarea name="isi">{{ $comment->isi }}</textarea><br><br>
    <button type="submit">Update</button>
</form>

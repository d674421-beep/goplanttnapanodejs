<h1>Buat Topik Forum</h1>

<form method="POST" action="/forum">
    @csrf
    <input type="text" name="judul" placeholder="Judul"><br><br>
    <textarea name="isi" placeholder="Isi topik"></textarea><br><br>
    <button type="submit">Kirim</button>
</form>

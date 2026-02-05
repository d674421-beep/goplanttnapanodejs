<h2>Halo {{ $reminder->user->name }}</h2>

<p>
Ini pengingat <strong>{{ $reminder->jenis_perawatan }}</strong>
untuk tanaman:
<strong>{{ $reminder->plant->nama }}</strong>
</p>

<p>
📅 Jadwal: {{ $reminder->jadwal->format('d M Y H:i') }}
</p>

<p>
Silakan lakukan perawatan sesuai jadwal.
</p>

<hr>
<p>GoPlant 🌱</p>

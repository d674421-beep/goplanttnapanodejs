<h2>{{ $reminder->title }}</h2>

<p>{{ $reminder->description }}</p>

<p>
    ⏰ <strong>Waktu:</strong>
    {{ $reminder->remind_at->format('d M Y H:i') }}
</p>

<hr>
<p>GoPlant 🌱</p>

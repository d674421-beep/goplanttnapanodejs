@csrf

<div class="form-wrapper">

    <div class="form-group">
        <label>Judul Pengingat</label>
        <input type="text"
               name="title"
               value="{{ old('title', $reminder->title ?? '') }}"
               required>
    </div>

    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description">{{ old('description', $reminder->description ?? '') }}</textarea>
    </div>

	<div class="form-group datetime-clickable"
		onclick="openDateTimePicker(this)">

		<label>Waktu Pengingat</label>

		<input type="datetime-local"
			name="remind_at"
			id="remind_at"
			value="{{ old('remind_at',
				isset($reminder)
				? $reminder->remind_at->format('Y-m-d\TH:i')
				: ''
			) }}"
			required>

		<small class="form-hint">
			Klik di area ini untuk memilih tanggal & jam
		</small>
	</div>
</div>
<script>
function openDateTimePicker(wrapper) {
    const input = wrapper.querySelector('input[type="datetime-local"]');

    // browser modern
    if (input.showPicker) {
        input.showPicker();
    } else {
        input.focus(); // fallback
    }
}
</script>

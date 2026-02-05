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

    <div class="form-group datetime-group" onclick="focusDateInput()">
        <label>Waktu Pengingat</label>

        <div class="datetime-box">
            <input id="remindAtInput"
                type="datetime-local"
                name="remind_at"
                value="{{ old('remind_at',
                    isset($reminder)
                    ? $reminder->remind_at->format('Y-m-d\TH:i')
                    : ''
                ) }}"
                required>
        </div>

        <small class="text-muted">
            Pilih tanggal dan jam, klik di mana saja di kotak
        </small>
    </div>
</div>
<script>
function focusDateInput() {
    document.getElementById('remindAtInput').showPicker?.(); // modern browser
    document.getElementById('remindAtInput').focus();
}
</script>
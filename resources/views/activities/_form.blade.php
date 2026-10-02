<div>
    <label for="category_id">Kategori *</label><br>
    <select id="category_id" name="category_id" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id', $activity->category_id ?? '') == $cat->id)>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="code">Kode Kegiatan *</label><br>
    <input
        id="code"
        name="code"
        type="text"
        value="{{ old('code', $activity->code ?? '') }}"
        required
    >
    @error('code')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="title">Judul Kegiatan *</label><br>
    <input
        id="title"
        name="title"
        type="text"
        value="{{ old('title', $activity->title ?? '') }}"
        required
    >
    @error('title')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="description">Deskripsi</label><br>
    <textarea
        id="description"
        name="description"
        rows="4"
    >{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="start_at">Tanggal & Waktu Mulai *</label><br>
    <input
        id="start_at"
        name="start_at"
        type="datetime-local"
        value="{{ old('start_at', isset($activity->start_at) ? $activity->start_at->format('Y-m-d\TH:i') : '') }}"
        required
    >
    @error('start_at')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="end_at">Tanggal & Waktu Selesai *</label><br>
    <input
        id="end_at"
        name="end_at"
        type="datetime-local"
        value="{{ old('end_at', isset($activity->end_at) ? $activity->end_at->format('Y-m-d\TH:i') : '') }}"
        required
    >
    @error('end_at')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="location">Lokasi *</label><br>
    <input
        id="location"
        name="location"
        type="text"
        value="{{ old('location', $activity->location ?? '') }}"
        required
    >
    @error('location')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="capacity">Kapasitas (Maks 500) *</label><br>
    <input
        id="capacity"
        name="capacity"
        type="number"
        min="1"
        max="500"
        value="{{ old('capacity', $activity->capacity ?? 50) }}"
        required
    >
    @error('capacity')
        <p style="color:red;">{{ $message }}</p>
    @enderror
</div>

<br>
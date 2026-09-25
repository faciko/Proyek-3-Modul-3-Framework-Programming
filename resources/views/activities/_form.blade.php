<label for="title">Judul</label>
<input
    id="title"
    name="title"
    type="text"
    value="{{ old('title', $activity->title ?? '') }}"
>
@error('title')
    <p>{{ $message }}</p>
@enderror

<br><br>

<label for="description">Deskripsi</label>
<textarea
    id="description"
    name="description"
>{{ old('description', $activity->description ?? '') }}</textarea>
@error('description')
    <p>{{ $message }}</p>
@enderror

<br><br>

<label for="activity_date">Tanggal</label>
<input
    id="activity_date"
    name="activity_date"
    type="date"
    value="{{ old('activity_date', isset($activity) ? $activity->activity_date->format('Y-m-d') : '') }}"
>
@error('activity_date')
    <p>{{ $message }}</p>
@enderror

<br><br>

<label for="category">Kategori</label>
<input
    id="category"
    name="category"
    type="text"
    value="{{ old('category', $activity->category ?? '') }}"
>
@error('category')
    <p>{{ $message }}</p>
@enderror

<br><br>

<label for="status">Status</label>
<select id="status" name="status">
    <option value="">-- Pilih Status --</option>
    <option value="Planned" @selected(old('status', $activity->status ?? '') === 'Planned')>
        Planned
    </option>
    <option value="Ongoing" @selected(old('status', $activity->status ?? '') === 'Ongoing')>
        Ongoing
    </option>
    <option value="Done" @selected(old('status', $activity->status ?? '') === 'Done')>
        Done
    </option>
</select>
@error('status')
    <p>{{ $message }}</p>
@enderror
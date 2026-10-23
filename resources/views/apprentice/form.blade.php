<div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $apprentice->name ?? '') }}" required>
    @error('name')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $apprentice->email ?? '') }}" required>
    @error('email')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Celular</label>
    <input type="text" name="cell_number" class="form-control" value="{{ old('cell_number', $apprentice->cell_number ?? '') }}" required>
    @error('cell_number')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Foto</label>
    <input id="apprentice-photo" type="file" name="photo" class="form-control" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
    <div class="form-text">Formatos permitidos: JPG, PNG o WEBP. Tamaño máximo: 2 MB.</div>
    <div id="apprentice-photo-preview" class="mt-3 {{ $apprentice?->photo ? '' : 'd-none' }}">
        <img
            id="apprentice-photo-preview-image"
            src="{{ $apprentice?->photo ? asset('storage/' . $apprentice->photo) : '' }}"
            alt="Vista previa de la foto"
            style="width: 120px; height: 120px; object-fit: cover; border-radius: 1rem;">
    </div>
    @if($apprentice?->photo)
        <p class="form-text">Si no seleccionas otra imagen, se conservará la foto actual.</p>
    @endif
    @error('photo')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Curso</label>
    <select name="course_id" class="form-control" required>
        <option value="">-- Seleccione un curso --</option>
        @foreach($courses as $course)
            <option value="{{ $course->id }}" {{ old('course_id', $apprentice->course_id ?? '') == $course->id ? 'selected' : '' }}>
                {{ $course->course_number }}
            </option>
        @endforeach
    </select>
    @error('course_id')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Computador (opcional)</label>
    <select name="computer_id" class="form-control">
        <option value="">-- Sin computador asignado --</option>
        @foreach($computers as $computer)
            <option value="{{ $computer->id }}" {{ old('computer_id', $apprentice->computer_id ?? '') == $computer->id ? 'selected' : '' }}>
                {{ $computer->number }} - {{ $computer->brand }}
            </option>
        @endforeach
    </select>
    @error('computer_id')<div class="text-danger">{{ $message }}</div>@enderror
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('apprentice-photo');
        const preview = document.getElementById('apprentice-photo-preview');
        const image = document.getElementById('apprentice-photo-preview-image');
        let previewUrl;

        input?.addEventListener('change', () => {
            const file = input.files?.[0];

            if (!file) {
                return;
            }

            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
            }

            previewUrl = URL.createObjectURL(file);
            image.src = previewUrl;
            preview.classList.remove('d-none');
        });
    });
</script>

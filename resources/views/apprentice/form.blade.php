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

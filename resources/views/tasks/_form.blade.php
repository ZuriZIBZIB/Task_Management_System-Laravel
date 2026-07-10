@php
    $task = $task ?? null;
@endphp

<div class="mb-3">
    <label for="title" class="form-label">Judul Task</label>
    <input type="text" id="title" name="title"
           value="{{ old('title', $task->title ?? '') }}"
           class="form-control @error('title') is-invalid @enderror" required autofocus>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea id="description" name="description" rows="4"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $task->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="priority" class="form-label">Prioritas</label>
        <select id="priority" name="priority" class="form-select @error('priority') is-invalid @enderror" required>
            <option value="">Pilih Prioritas</option>
            @foreach (['low' => 'Low', 'medium' => 'Medium', 'high' => 'High'] as $value => $label)
                <option value="{{ $value }}" {{ old('priority', $task->priority ?? '') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('priority')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="status" class="form-label">Status</label>
        <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
            <option value="">Pilih Status</option>
            @foreach (['to_do' => 'To Do', 'in_progress' => 'In Progress', 'done' => 'Done'] as $value => $label)
                <option value="{{ $value }}" {{ old('status', $task->status ?? '') === $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="date" id="deadline" name="deadline"
               value="{{ old('deadline', isset($task->deadline) ? $task->deadline->format('Y-m-d') : '') }}"
               class="form-control @error('deadline') is-invalid @enderror">
        @error('deadline')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
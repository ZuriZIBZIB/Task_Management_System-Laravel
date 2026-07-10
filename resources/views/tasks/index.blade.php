@extends('layouts.app')

@section('title', 'Daftar Task')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Daftar Task</h3>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            + Tambah Task
        </a>
    </div>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('tasks.index') }}" class="row g-2 align-items-center">
                <div class="col-md-6">
                    <input type="text" name="search" value="{{ $search }}"
                           class="form-control" placeholder="Cari judul atau deskripsi task...">
                </div>

                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="to_do" {{ $statusFilter === 'to_do' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ $statusFilter === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ $statusFilter === 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if ($tasks->isEmpty())
                <div class="text-center text-muted py-5">
                    Belum ada task. Yuk mulai tambahkan task pertamamu!
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Judul</th>
                                <th>Prioritas</th>
                                <th>Status</th>
                                <th>Deadline</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>
                                        <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none fw-semibold">
                                            {{ $task->title }}
                                        </a>
                                    </td>
                                    <td><x-priority-badge :priority="$task->priority" /></td>
                                    <td><x-status-badge :status="$task->status" /></td>
                                    <td>
                                        {{ $task->deadline ? $task->deadline->format('d M Y') : '-' }}
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-secondary">
                                            Edit
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus task ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        @if ($tasks->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $tasks->links() }}
            </div>
        @endif
    </div>
@endsection
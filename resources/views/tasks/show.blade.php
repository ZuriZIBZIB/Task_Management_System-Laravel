@extends('layouts.app')

@section('title', 'Detail Task')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Detail Task</h3>
        <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary btn-sm">
            &larr; Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h4 class="fw-bold">{{ $task->title }}</h4>

            <div class="mb-3">
                <x-priority-badge :priority="$task->priority" />
                <x-status-badge :status="$task->status" />
            </div>

            <p class="text-muted mb-4">
                {{ $task->description ?: 'Tidak ada deskripsi.' }}
            </p>

            <table class="table table-borderless w-auto">
                <tr>
                    <td class="text-muted">Deadline</td>
                    <td class="fw-semibold">
                        {{ $task->deadline ? $task->deadline->format('d F Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="text-muted">Dibuat oleh</td>
                    <td class="fw-semibold">{{ $task->user->name }}</td>
                </tr>
                <tr>
                    <td class="text-muted">Dibuat pada</td>
                    <td class="fw-semibold">{{ $task->created_at->format('d F Y, H:i') }}</td>
                </tr>
            </table>

            <div class="mt-3">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus task ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
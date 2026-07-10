@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h3 class="fw-bold mb-4">Dashboard</h3>
    <p class="text-muted mb-4">Selamat datang kembali, {{ Auth::user()->name }}!</p>

    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">Total Task</div>
                    <div class="fs-3 fw-bold text-primary">{{ $totalTasks }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">To Do</div>
                    <div class="fs-3 fw-bold text-secondary">{{ $todoCount }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">In Progress</div>
                    <div class="fs-3 fw-bold text-warning">{{ $inProgressCount }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-1">Done</div>
                    <div class="fs-3 fw-bold text-success">{{ $doneCount }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 pt-3">
            <h6 class="fw-bold mb-0">Task Mendekati Deadline (7 hari ke depan)</h6>
        </div>
        <div class="card-body pt-0">
            @if ($upcomingTasks->isEmpty())
                <p class="text-muted mb-0">Tidak ada task yang mendekati deadline. Aman!</p>
            @else
                <div class="table-responsive">
                    <table class="table table-borderless align-middle mb-0">
                        <thead class="border-bottom">
                            <tr>
                                <th>Judul</th>
                                <th>Prioritas</th>
                                <th>Status</th>
                                <th>Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($upcomingTasks as $task)
                                <tr>
                                    <td>
                                        <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none">
                                            {{ $task->title }}
                                        </a>
                                    </td>
                                    <td>
                                        @php
                                            $priorityColor = match($task->priority) {
                                                'high' => 'danger',
                                                'medium' => 'warning',
                                                'low' => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $priorityColor }}">
                                            {{ ucfirst($task->priority) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ str($task->status)->replace('_', ' ')->title() }}
                                        </span>
                                    </td>
                                    <td>{{ $task->deadline->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
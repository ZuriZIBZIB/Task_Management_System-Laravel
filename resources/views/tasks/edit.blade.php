@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <h3 class="fw-bold mb-4">Edit Task</h3>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')
                @include('tasks._form')

                <button type="submit" class="btn btn-primary">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
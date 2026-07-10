<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $tasks = Auth::user()->tasks()
            ->search($request->search)
            ->status($request->status)
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('tasks.index', [
            'tasks' => $tasks,
            'search' => $request->search,
            'statusFilter' => $request->status,
        ]);
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request)
    {
        Auth::user()->tasks()->create($request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task berhasil ditambahkan.');
    }

    public function show(Task $task)
    {
        $this->authorizeTask($task);

        return view('tasks.show', ['task' => $task]);
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);

        return view('tasks.edit', ['task' => $task]);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorizeTask($task);

        $task->update($request->validated());

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task berhasil diperbarui.');
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task berhasil dihapus.');
    }

    private function authorizeTask(Task $task): void
    {
        abort_if($task->user_id !== Auth::id(), 403, 'Anda tidak memiliki akses ke task ini.');
    }
}
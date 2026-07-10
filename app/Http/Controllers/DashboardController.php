<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks();

        $totalTasks = (clone $tasks)->count();
        $todoCount = (clone $tasks)->where('status', 'to_do')->count();
        $inProgressCount = (clone $tasks)->where('status', 'in_progress')->count();
        $doneCount = (clone $tasks)->where('status', 'done')->count();

        $upcomingTasks = (clone $tasks)
            ->whereNotNull('deadline')
            ->whereDate('deadline', '>=', Carbon::today())
            ->whereDate('deadline', '<=', Carbon::today()->addDays(7))
            ->where('status', '!=', 'done')
            ->orderBy('deadline')
            ->take(5)
            ->get();

        return view('dashboard', [
            'totalTasks' => $totalTasks,
            'todoCount' => $todoCount,
            'inProgressCount' => $inProgressCount,
            'doneCount' => $doneCount,
            'upcomingTasks' => $upcomingTasks,
        ]);
    }
}
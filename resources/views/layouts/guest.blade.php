<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Task Management System') }} - @yield('title', 'Login')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="w-100" style="max-width: 420px;">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-primary">Task Management System</h4>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>
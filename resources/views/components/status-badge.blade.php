@props(['status'])

@php
    $color = match ($status) {
        'to_do' => 'secondary',
        'in_progress' => 'warning',
        'done' => 'success',
        default => 'light',
    };
@endphp

<span class="badge bg-{{ $color }}">{{ str($status)->replace('_', ' ')->title() }}</span>
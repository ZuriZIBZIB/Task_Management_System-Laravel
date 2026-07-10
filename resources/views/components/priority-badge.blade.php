@props(['priority'])

@php
    $color = match ($priority) {
        'high' => 'danger',
        'medium' => 'warning',
        'low' => 'secondary',
        default => 'light',
    };
@endphp

<span class="badge bg-{{ $color }}">{{ ucfirst($priority) }}</span>
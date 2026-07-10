<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'priority' => ['required', 'in:low,medium,high'],
            'status' => ['required', 'in:to_do,in_progress,done'],
            'deadline' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul task wajib diisi.',
            'priority.required' => 'Prioritas wajib dipilih.',
            'priority.in' => 'Prioritas yang dipilih tidak valid.',
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid.',
            'deadline.date' => 'Format tanggal deadline tidak valid.',
        ];
    }
}
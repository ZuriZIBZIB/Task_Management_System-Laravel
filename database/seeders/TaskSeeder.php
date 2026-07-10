<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();  

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Mozi',
                'email' => 'mozi@gmail.com',
                'password' => bcrypt('password'),
            ]);
        }

        $statuses = ['to_do', 'in_progress', 'done'];
        $priorities = ['low', 'medium', 'high'];

        $titles = [
            'Buat laporan mingguan',
            'Review kode tim frontend',
            'Meeting koordinasi proyek',
            'Update dokumentasi API',
            'Testing fitur login',
            'Perbaikan bug dashboard',
            'Setup server staging',
            'Desain ulang halaman profil',
            'Backup database bulanan',
            'Presentasi hasil sprint',
            'Optimasi query database',
            'Integrasi payment gateway',
        ];

        foreach ($titles as $title) {
            $user->tasks()->create([
                'title' => $title,
                'description' => 'Deskripsi singkat untuk task: ' . $title,
                'priority' => $priorities[array_rand($priorities)],
                'status' => $statuses[array_rand($statuses)],
                'deadline' => now()->addDays(rand(-5, 14)),
            ]);
        }
    }
}
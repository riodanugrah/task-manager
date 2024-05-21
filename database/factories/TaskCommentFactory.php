<?php

namespace Database\Factories;

use App\Models\TaskComment; // Pastikan namespace ini sesuai dengan lokasi model TaskComment Anda
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TaskComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_id' => 1, // Asumsi setiap komentar terkait dengan task yang dibuat secara otomatis
            'user_id' => 3, // Asumsi menggunakan user dengan ID 3
            'comment' => $this->faker->paragraph, // Menggunakan paragraph untuk komentar
            // Tambahkan field lain sesuai dengan struktur tabel TaskComment Anda
        ];
    }
}

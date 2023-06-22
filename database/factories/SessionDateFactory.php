<?php

namespace Database\Factories;

use App\Models\SessionDate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SessionDate>
 */
class SessionDateFactory extends Factory
{
    protected $model = SessionDate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = '2023-06-01';
        $endDate = '2023-09-30';

        return [
            'teacher_id' => function () {
                return User::whereHas('profile', function($q) {
                    $q->where('user_type', 0);
                })->inRandomOrder()->first()->id;
            },
            'session_date' => fake()->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
        ];
    }
}

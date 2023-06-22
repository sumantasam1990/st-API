<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genders = ['male', 'female'];
        $userTypes = [0, 1];
        $startDate = '1970-01-01';
        $endDate = '2003-12-31';

        return [
            'dob' => fake()->dateTimeBetween($startDate, $endDate)->format('Y-m-d'),
            'user_id' => User::factory()->create()->id,
            'gender' => fake()->randomElement($genders),
            'user_type' => fake()->randomElement($userTypes),
        ];
    }
}

<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Year;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $yearIds = Year::pluck('id')->toArray();

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'student_code' => Str::random(10),
            'class_id' => null,
            'dob' => $this->faker->dateTimeBetween('-18 years', '-5 years')->format('Y-m-d'),
            'mother_name' => $this->faker->name('female'),
            'father_name' => $this->faker->name('male'),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'enrollment_date' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'student_image_uri' => $this->faker->imageUrl,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->address,
            'class' => $this->faker->numberBetween(1, 12),
            'section' => $this->faker->randomLetter,
            'password' => bcrypt('password'),
            'year_id' => $this->faker->randomElement($yearIds),
            'type' => $this->faker->word,
            'month' => $this->faker->monthName,
            'time' => $this->faker->time,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

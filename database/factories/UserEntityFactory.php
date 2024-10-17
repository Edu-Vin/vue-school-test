<?php

namespace Database\Factories;

use App\Entities\Users\UserEntity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserEntityFactory extends Factory
{
    /**
     * Default timezones provided
     *
     * @var string[]
     */
    private $defaultTimeZones = ["CET", "CST", "GMT+1"];

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserEntity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'time_zone' => fake()->randomElement($this->defaultTimeZones),
            'email_verified_at' => now(),
            'password' => Hash::make(fake()->password), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

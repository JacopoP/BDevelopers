<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // Store in array first and last name
        $name = fake()->firstName();
        $last = fake()->lastName();

        $email = '';
        $failed = 0;
        do {
            $email = $this::emailForNames($name, $last . ($failed ? fake()->year() : ''));
            $failed++;
        } while (User::where('email', $email)->get()->count());

        return [
            'name' => $name,
            'last' => $last,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
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


    /**
     * Generates fake email with given names
     *
     * @return string
     */
    public static function emailForNames($name, $last)
    {
        // Allowed chars
        $regex = '/[^A-Za-z0-9\-]/';

        // Store in array first and last name
        $firstLast = [
            preg_replace($regex, '', $name), 
            preg_replace($regex, '', $last)
        ];

        // Random decide how to compose mail
        $emailNameFirst = fake()->boolean();

        // Generate mail
        $email = $firstLast[$emailNameFirst]
            // second name
            . '.' . $firstLast[!$emailNameFirst]
            // email domain
            . '@' . fake()->freeEmailDomain();
        $email = strtolower($email);

        return $email;
    }
}

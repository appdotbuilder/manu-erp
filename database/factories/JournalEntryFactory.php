<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JournalEntry>
 */
class JournalEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $amount = fake()->randomFloat(2, 100, 10000);

        return [
            'entry_number' => fake()->unique()->bothify('JE-####-??##'),
            'date' => fake()->dateTimeBetween('-1 year', 'now'),
            'description' => fake()->sentence(),
            'reference' => fake()->optional()->bothify('REF-######'),
            'total_debit' => $amount,
            'total_credit' => $amount,
            'status' => fake()->randomElement(['draft', 'posted']),
        ];
    }

    /**
     * Indicate that the journal entry is posted.
     */
    public function posted(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'posted',
        ]);
    }
}
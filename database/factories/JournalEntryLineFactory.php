<?php

namespace Database\Factories;

use App\Models\ChartOfAccounts;
use App\Models\JournalEntry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JournalEntryLine>
 */
class JournalEntryLineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isDebit = fake()->boolean();
        $amount = fake()->randomFloat(2, 50, 5000);

        return [
            'journal_entry_id' => JournalEntry::factory(),
            'account_id' => ChartOfAccounts::factory(),
            'description' => fake()->optional()->sentence(),
            'debit_amount' => $isDebit ? $amount : 0,
            'credit_amount' => !$isDebit ? $amount : 0,
        ];
    }

    /**
     * Indicate that this is a debit entry.
     */
    public function debit(): static
    {
        return $this->state(fn (array $attributes) => [
            'debit_amount' => fake()->randomFloat(2, 50, 5000),
            'credit_amount' => 0,
        ]);
    }

    /**
     * Indicate that this is a credit entry.
     */
    public function credit(): static
    {
        return $this->state(fn (array $attributes) => [
            'debit_amount' => 0,
            'credit_amount' => fake()->randomFloat(2, 50, 5000),
        ]);
    }
}
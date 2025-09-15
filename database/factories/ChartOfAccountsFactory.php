<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ChartOfAccounts>
 */
class ChartOfAccountsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['asset', 'liability', 'equity', 'revenue', 'expense'];
        $type = fake()->randomElement($types);
        
        $subTypes = [
            'asset' => ['current_asset', 'fixed_asset'],
            'liability' => ['current_liability', 'long_term_liability'],
            'equity' => ['equity'],
            'revenue' => ['operating_revenue', 'non_operating_revenue'],
            'expense' => ['operating_expense', 'non_operating_expense'],
        ];

        $normalBalance = in_array($type, ['asset', 'expense']) ? 'debit' : 'credit';

        return [
            'code' => fake()->unique()->numerify('####'),
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'type' => $type,
            'sub_type' => fake()->randomElement($subTypes[$type]),
            'balance' => fake()->randomFloat(2, 0, 100000),
            'normal_balance' => $normalBalance,
            'is_active' => fake()->boolean(90),
        ];
    }

    /**
     * Indicate that the account is an asset.
     */
    public function asset(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'asset',
            'sub_type' => fake()->randomElement(['current_asset', 'fixed_asset']),
            'normal_balance' => 'debit',
        ]);
    }

    /**
     * Indicate that the account is a liability.
     */
    public function liability(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'liability',
            'sub_type' => fake()->randomElement(['current_liability', 'long_term_liability']),
            'normal_balance' => 'credit',
        ]);
    }
}
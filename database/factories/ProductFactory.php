<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productTypes = ['raw_material', 'work_in_progress', 'finished_goods'];
        $units = ['PCS', 'KG', 'LTR', 'MTR', 'SET'];

        return [
            'code' => fake()->unique()->bothify('PRD-###??'),
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'type' => fake()->randomElement($productTypes),
            'cost' => fake()->randomFloat(2, 10, 500),
            'price' => fake()->randomFloat(2, 15, 750),
            'stock_quantity' => fake()->numberBetween(0, 1000),
            'reorder_level' => fake()->numberBetween(10, 100),
            'unit' => fake()->randomElement($units),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }

    /**
     * Indicate that the product is a raw material.
     */
    public function rawMaterial(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'raw_material',
            'cost' => fake()->randomFloat(2, 5, 100),
            'price' => fake()->randomFloat(2, 8, 150),
        ]);
    }

    /**
     * Indicate that the product is a finished good.
     */
    public function finishedGood(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'finished_goods',
            'cost' => fake()->randomFloat(2, 50, 300),
            'price' => fake()->randomFloat(2, 75, 450),
        ]);
    }

    /**
     * Indicate that the product has low stock.
     */
    public function lowStock(): static
    {
        return $this->state(function (array $attributes) {
            $reorderLevel = fake()->numberBetween(20, 50);
            return [
                'reorder_level' => $reorderLevel,
                'stock_quantity' => fake()->numberBetween(0, $reorderLevel - 5),
            ];
        });
    }
}
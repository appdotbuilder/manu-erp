<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesOrder>
 */
class SalesOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 1000, 50000);
        $taxAmount = $subtotal * 0.1; // 10% tax
        $totalAmount = $subtotal + $taxAmount;

        $orderDate = fake()->dateTimeBetween('-6 months', 'now');
        $deliveryDate = fake()->dateTimeBetween($orderDate, '+30 days');

        return [
            'so_number' => fake()->unique()->bothify('SO-####-??##'),
            'customer_id' => Customer::factory(),
            'order_date' => $orderDate,
            'delivery_date' => $deliveryDate,
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount,
            'status' => fake()->randomElement(['draft', 'confirmed', 'delivered', 'cancelled']),
            'notes' => fake()->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the sales order is confirmed.
     */
    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'confirmed',
        ]);
    }

    /**
     * Indicate that the sales order is delivered.
     */
    public function delivered(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'delivered',
        ]);
    }
}
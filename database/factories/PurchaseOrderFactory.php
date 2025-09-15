<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseOrder>
 */
class PurchaseOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $orderDate = fake()->dateTimeBetween('-6 months', 'now');
        $expectedDeliveryDate = fake()->dateTimeBetween($orderDate, '+30 days');

        return [
            'po_number' => fake()->unique()->bothify('PO-####-??##'),
            'vendor_id' => Vendor::factory(),
            'order_date' => $orderDate,
            'expected_delivery_date' => $expectedDeliveryDate,
            'total_amount' => fake()->randomFloat(2, 1000, 50000),
            'status' => fake()->randomElement(['draft', 'sent', 'received', 'cancelled']),
            'notes' => fake()->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the purchase order is in draft status.
     */
    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
        ]);
    }

    /**
     * Indicate that the purchase order is sent.
     */
    public function sent(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'sent',
        ]);
    }

    /**
     * Indicate that the purchase order is received.
     */
    public function received(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'received',
        ]);
    }
}
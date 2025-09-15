<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->slug(2),
            'display_name' => fake()->jobTitle(),
            'description' => fake()->sentence(),
        ];
    }

    /**
     * Indicate that the role is super admin.
     */
    public function superAdmin(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'super_admin',
            'display_name' => 'Super Admin',
            'description' => 'Has full access to all modules and features',
        ]);
    }

    /**
     * Indicate that the role is sales manager.
     */
    public function salesManager(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'sales_manager',
            'display_name' => 'Sales Manager',
            'description' => 'Can manage sales, customers, and view finished goods inventory',
        ]);
    }

    /**
     * Indicate that the role is inventory manager.
     */
    public function inventoryManager(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'inventory_manager',
            'display_name' => 'Inventory Manager',
            'description' => 'Can manage all inventory and view purchase orders',
        ]);
    }

    /**
     * Indicate that the role is partner user.
     */
    public function partnerUser(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'partner_user',
            'display_name' => 'Partner User',
            'description' => 'Focuses on sales performance and finished goods inventory',
        ]);
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $actions = ['view', 'create', 'edit', 'delete'];
        $modules = ['inventory', 'sales', 'purchasing', 'finance', 'hr'];
        
        $action = fake()->randomElement($actions);
        $module = fake()->randomElement($modules);
        
        return [
            'name' => "{$action}-{$module}",
            'display_name' => ucfirst($action) . ' ' . ucfirst($module),
            'module' => $module,
            'description' => "Permission to {$action} {$module} data",
        ];
    }

    /**
     * Create a permission for a specific module and action.
     */
    public function forModule(string $module, string $action): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => "{$action}-{$module}",
            'display_name' => ucfirst($action) . ' ' . ucfirst($module),
            'module' => $module,
            'description' => "Permission to {$action} {$module} data",
        ]);
    }
}
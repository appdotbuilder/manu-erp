<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = ['Production', 'Quality Control', 'Warehouse', 'Sales', 'Finance', 'HR', 'IT', 'Management'];
        $jobTitles = [
            'Production' => ['Production Manager', 'Machine Operator', 'Assembly Worker', 'Production Supervisor'],
            'Quality Control' => ['QC Inspector', 'QC Manager', 'Test Engineer'],
            'Warehouse' => ['Warehouse Manager', 'Forklift Operator', 'Inventory Clerk'],
            'Sales' => ['Sales Manager', 'Sales Representative', 'Account Manager'],
            'Finance' => ['Finance Manager', 'Accountant', 'Financial Analyst'],
            'HR' => ['HR Manager', 'HR Specialist', 'Recruiter'],
            'IT' => ['IT Manager', 'System Administrator', 'Software Developer'],
            'Management' => ['General Manager', 'Operations Manager', 'Plant Manager']
        ];

        $department = fake()->randomElement($departments);
        $jobTitle = fake()->randomElement($jobTitles[$department]);

        return [
            'employee_id' => fake()->unique()->bothify('EMP-####'),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'hire_date' => fake()->dateTimeBetween('-10 years', 'now'),
            'job_title' => $jobTitle,
            'department' => $department,
            'salary' => fake()->randomFloat(2, 30000, 120000),
            'address' => fake()->address(),
            'date_of_birth' => fake()->dateTimeBetween('-65 years', '-18 years'),
            'status' => fake()->randomElement(['active', 'inactive', 'terminated']),
        ];
    }

    /**
     * Indicate that the employee is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the employee is a manager.
     */
    public function manager(): static
    {
        return $this->state(fn (array $attributes) => [
            'job_title' => fake()->randomElement([
                'Production Manager', 'QC Manager', 'Warehouse Manager',
                'Sales Manager', 'Finance Manager', 'HR Manager', 'IT Manager'
            ]),
            'salary' => fake()->randomFloat(2, 70000, 120000),
        ]);
    }
}
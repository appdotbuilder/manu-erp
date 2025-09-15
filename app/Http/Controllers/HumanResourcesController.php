<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Inertia\Inertia;

class HumanResourcesController extends Controller
{
    /**
     * Display a listing of employees.
     */
    public function index()
    {
        $employees = Employee::active()
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(20);

        $departmentCounts = Employee::active()
            ->selectRaw('department, COUNT(*) as employee_count')
            ->groupBy('department')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->department => (int) $item->getAttribute('employee_count')];
            });

        $metrics = [
            'total_employees' => Employee::active()->count(),
            'total_departments' => Employee::active()->distinct('department')->count(),
            'average_salary' => Employee::active()->avg('salary'),
            'total_payroll' => Employee::active()->sum('salary'),
        ];

        return Inertia::render('hr/index', [
            'employees' => $employees,
            'departmentCounts' => $departmentCounts,
            'metrics' => $metrics,
        ]);
    }

    /**
     * Display the specified employee.
     */
    public function show(Employee $employee)
    {
        return Inertia::render('hr/show', [
            'employee' => $employee,
        ]);
    }
}
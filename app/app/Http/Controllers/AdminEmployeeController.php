<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class AdminEmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        $positions = Employee::select('position')->distinct()->pluck('position');

        return view('admin.employees.index', compact('employees', 'positions'));
    }

    // ===== STORE =====
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'bio'       => 'nullable|string',
            'photo'     => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('employees', 'public');
        }

        Employee::create($validated);

        return back()->with('success', 'Zaposleni uspešno dodat.');
    }

    // ===== UPDATE =====
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'position'  => 'required|string|max:255',
            'bio'       => 'nullable|string',
            'photo'     => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('employees', 'public');
        }

        $employee->update($validated);

        return back()->with('success', 'Podaci zaposlenog uspešno izmenjeni.');
    }

    // ===== DELETE =====
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return back()->with('success', 'Zaposleni uspešno obrisan.');
    }
}

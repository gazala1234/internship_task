<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Add this

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('company')->paginate(10);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('employees.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image',
        ]);

        $employee = Employee::create($request->except('profile_picture')); // Exclude profile_picture for now

        if ($request->hasFile('profile_picture')) {
            // Store the file in the private disk
            $path = $request->file('profile_picture')->store('', 'private');
            $employee->update(['profile_picture' => $path]);
        }

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return view('employees.edit', compact('employee', 'companies'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'profile_picture' => 'nullable|image',
        ]);

        $employee->update($request->except('profile_picture')); // Exclude profile_picture for now

        if ($request->hasFile('profile_picture')) {
            // Store the file in the private disk
            $path = $request->file('profile_picture')->store('', 'private');
            $employee->update(['profile_picture' => $path]);
        }

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        // Optionally delete the profile picture if required
        if ($employee->profile_picture) {
            Storage::disk('private')->delete($employee->profile_picture);
        }
        
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}

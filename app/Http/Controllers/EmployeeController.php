<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;  // Added Storage import

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:100',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:5120',
        ]);

        $data = $request->except(['image', 'file']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('employees/images', 'public');
            $data['image'] = $imagePath;
        }

        // Handle file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('employees/files', 'public');
            $data['file'] = $filePath;
        }

        Employee::create($data);

        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:100',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:5120',
        ]);

        $data = $request->except(['image', 'file']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($employee->image && Storage::disk('public')->exists($employee->image)) {
                Storage::disk('public')->delete($employee->image);
            }
            $imagePath = $request->file('image')->store('employees/images', 'public');
            $data['image'] = $imagePath;
        }

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($employee->file && Storage::disk('public')->exists($employee->file)) {
                Storage::disk('public')->delete($employee->file);
            }
            $filePath = $request->file('file')->store('employees/files', 'public');
            $data['file'] = $filePath;
        }

        $employee->update($data);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        // Delete associated files
        if ($employee->image && Storage::disk('public')->exists($employee->image)) {
            Storage::disk('public')->delete($employee->image);
        }
        if ($employee->file && Storage::disk('public')->exists($employee->file)) {
            Storage::disk('public')->delete($employee->file);
        }

        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
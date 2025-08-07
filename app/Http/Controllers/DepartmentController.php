<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }
        $departments= Department :: all(); // Fetch all departments
        return view('departments.index', compact('departments'));
    } 

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }
        $departments = Employee :: select('department_id')-> distinct()->pluck('department_id');
        return view('departments.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required|string|unique:departments,name'
            ]);

            // Only pass validated input
            Department::create([
                'name' => $request->name,
            ]);
            return redirect()->route('departments.index')->with('success', 'Department added successfully!');
        }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }
        $department = Department::findOrFail($id);
        $request -> validate([
            'name' => 'required|string|max:255',
        ]);
        if ($request -> name === $department ->name){
            return redirect()->back()->with('info','No Change Found');
        }
        
        $department = Department::findOrFail($id);
        $department -> update($request -> only('name'));
        return redirect()->route('departments.index')->with('success', 'Department update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()-> route('departments.index')-> with('success','Department deleted successfully');
    }
}

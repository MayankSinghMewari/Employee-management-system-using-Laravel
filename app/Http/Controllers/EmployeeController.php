<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\PublicPath;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function deshbord()  
    {
        return view('employees.deshbord'); 
    }
    
    /**
     * Show the form of employee list.
     */
    public function index()
    {
        //phpinfo();
        //die;
        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }
        $employees = employee::with('department')->where('is_deleted', 0)-> get();
        return view('employees.index', ['employees' => $employees]);
    }

     /**
     * Show the form of employee profile.
     */
    public function profile()
    {
        $userId = auth()->id();
        $employee = Employee::where('user_id', $userId)->first(); // or ->get() if expecting multiple
        return view('employees.profile',compact('employee'));
    
    }

    /**Profile update */

    public function profile_update(Request $request)
    {
        

        $userId = auth()->id();
        $employee = Employee::where('user_id', $userId)->first(); 

        $employee->gender=$request->gender;

        $employee->save();

        //echo "<pre>";
        //print_r($employee);
        //die("update profile");

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }

        $departments = Department::pluck('name', 'id'); // ['id' => 'name']
        return view('employees.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }
        $validated = $request->validate([
            'first_name' => 'required',
            'second_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'confirm_email' => 'required|same:email',
            'gender' => 'required',
            'department_id' => 'required|exists:departments,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ],
        [
            'department_id.required' => 'Please select a department.',
        ]
    );


    if (User::where('email', $validated['email'])->exists()) {
        return back()->withErrors(['email' => 'This email is already taken.'])->withInput();
    }


        $user = User::create([
                'name' => $validated['first_name'] . ' ' . $validated['second_name'] . ' ' . $validated['last_name'],
                'email' => $validated['email'],
                'password' => Hash::make($request->password ?? 'SuperDuper@1'),
                'is_superuser' => 0,
        ]);

        $imagePath=null;
        // Handle image upload if a new image is provided
        if ($request->hasFile('fileToUpload')) {
            $image = $request->file('fileToUpload');

            // Store new image in public/uploads
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $filename);

            // Save filename to the database
            $imagePath = $filename;
        }


        $emp=\App\Models\Employee::create([
            'first_name' => $validated['first_name'],
            'second_name' => $validated['second_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'user_id' => $user->id,
            'gender' => $validated['gender'],
            'department_id' => $validated['department_id'],
            'image' => $imagePath,
            'is_active' => 1,
            'is_deleted' => 0
        ]);

        

        return redirect()->route('index')->with('success', 'Employee added successfully!');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }

        $employee = Employee::findOrFail($id);
        $departments = Department::pluck('name', 'id'); // ['id' => 'name']
        return view('employees.edit', compact('employee', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }
     
        $submit = $request->input('submit');
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'department_id' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $employee = Employee::findOrFail($id);

        // If no user is linked, create one
        if (!$employee->user_id) {
            // Ensure required fields are available
            if (!$request->email) {
                return back()->withErrors(['email' => 'Email is required to create a user account.']);
            }

            // Create user
            $user = User::create([
                'name' => $employee->first_name . ' ' . $employee->Second_name .  ' ' . $employee->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password ?? 'SuperDuper@1'),
                'is_superuser' => 0,
            ]);

            // Link employee to user
            if ($user) {
                $employee->user_id = $user->id;
                $employee->save();
            }
        }

        // Update user password if provided
        if (!empty($request->password)) {
            $user = User::find($employee->user_id);
            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        }



        // Handle image upload if a new image is provided
        if ($request->hasFile('fileToUpload')) {
            $image = $request->file('fileToUpload');

            // Delete old image if it exists
            $oldPath = public_path('uploads/' . $employee->image);
            if ($employee->image && file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Store new image in public/uploads
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $filename);

            // Save filename to the database
            $employee->image = $filename;
        }

        // Update other employee fields
        $employee->first_name = $validated['first_name'];
        $employee->second_name = $validated['second_name'];
        $employee->last_name = $validated['last_name'];
        $employee->email = $validated['email'];
        $employee->department_id = $validated['department_id'] ?? null;
        $employee->save();

        return redirect()->route('index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->user()->is_superuser) {
            abort(403, 'Access denied.');
        }
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('index')->with('success', 'Employee deleted successfully.');
    }

}

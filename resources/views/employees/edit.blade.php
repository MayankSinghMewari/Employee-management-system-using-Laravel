@extends('layouts.app')
@section('title', 'Edit Employee')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Employee</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 40px;
        }
        .card {
            max-width: 600px;
            margin: auto;
            border-radius: 12px;
        }
    </style>
</head>
@section('content')

<body>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Employee</h4>
        </div>
        <div class="card-body">
        <form action="{{ route('update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $employee->first_name }}" required>
            </div>

            <div class="mb-3">
                <label for="second_name" class="form-label">Second Name</label>
                <input type="text" name="second_name" id="second_name" class="form-control" value="{{ $employee->second_name }}" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $employee->last_name }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $employee->email }}" required>
            </div>

            <div class="mb-3">
                <label for="department_id" class="form-label">Department</label>
                        <select name="department_id" id="department_id" class="form-select" required>
                            <option value="">-- Select Department --</option>
                            @foreach($departments as $id => $name)
                                <option value="{{ $id }}" {{ (old('department_id', $employee->department_id ?? '') == $id) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
            </div>

            <div class="mb-3">
                    <div class="mb-3">
                        <label for="fileToUpload" class="form-label">Select image to upload:</label>
                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" >
                    </div>
                  
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (fille only when need to change password)</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
        

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary w-100 me-2">Update</button>
                <a href="{{ route('index') }}" class="btn btn-primary w-100 ms-2">Cancel</a>
            </div>
        </form>

        </div>
    </div>
</div>

</body>
@endsection
</html>

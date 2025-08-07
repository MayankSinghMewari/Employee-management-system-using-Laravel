@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            padding: 40px;
            background-color: #006cd8ff;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger shadow">
            <h4 class="alert-heading">Delete Confirmation</h4>
            <p>
                Are you sure you want to delete the employee 
                <strong>{{ $employee->first_name }} {{ $employee->second_name }}</strong>?
            </p>
        </div>

        <form action="{{ route('destroy', $employee->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="{{ route('index') }}" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </div>

    <!-- Optional Bootstrap JS (not needed here but good to have in general) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

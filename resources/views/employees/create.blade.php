@extends('layouts.app')
@section('title', 'Add Employee')

<!DOCTYPE html>
<html>
<head>
    <title>Create Employee</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
@section('content')
    <body style="background-color: #f8f9fa;">
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 bg-white p-5 rounded shadow-sm">

                <h2 class="mb-4 text-center">Add Employee</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops! Something went wrong:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" id="first_name" name="first_name" value="{{ old('first_name',  '') }}" class="form-control" autocomplete="given-name" >
                    </div>

                    <div class="mb-3">
                        <label for="second_name" class="form-label">Second Name</label>
                        <input type="text" id="second_name" name="second_name" class="form-control" value="{{ old('second_name',  '') }}" >
                    </div>

                    <div class = "mb-3">
                        <label for="last_name" class="form-lable">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" value="{{old('last_name', '')}}"> 

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email',  '') }}" autocomplete="email" >
                    </div>
                    <div class="mb-3">

                    <div class="mb-3">
                        <label for="confirm email" class="form-label">Re-Enter Your Email address</label>
                        <input type="email" id="confirm email" name="confirm email" class="form-control" value=" {{ old('confirm email',  '') }}" autocomplete="email" >
                    </div>
                    <div class="mb-3">

                    <label class="form-label">Gender</label>

                    <div class="d-flex gap-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender_m" value="Male"
                                {{ old('gender') == 'Male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_m">Male</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender_f" value="Female"
                                {{ old('gender') == 'Female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender_f">Female</label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender_o" value="Other"
                                {{ old('gender', 'Other') == 'Other' ? 'checked' : '' }} >
                            <label class="form-check-label" for="gender_o">Other</label>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="department_id" class="form-label">Department</label>
                        <select name="department_id" id="department_id" class="form-select" >
                            <option value="">-- Select Department --</option>
                            @foreach($departments as $id => $name)
                                <option value="{{ $id }}" {{ old('department_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="fileToUpload" class="form-label">Select image to upload:</label>
                        <input type="file" class="form-control" name="fileToUpload" id="fileToUpload" >
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary w-100 me-2">Save</button>
                        <a href="{{ route('index') }}" class="btn btn-secondary w-100 ms-2">Cancel</a>
                    </div>
                </form>

            </div>
        </div>
    </body>
@endsection
</html>

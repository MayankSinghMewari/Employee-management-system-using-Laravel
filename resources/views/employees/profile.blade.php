@extends('layouts.app')
@section('title', 'Employee Profile')
@section('content')
    <h1>Employee Profile</h1>

    <div class="card">
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-info alert-dismissible fade show mt-2" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <h1> {{session('success')}}</h1>
            <form action = "" method="post">
                @csrf
                <p><strong>First Name</strong> {{$employee->first_name}}</p>
                <p><strong>Last Name</strong> {{$employee->second_name}}</p>
                <p><strong>Email:</strong> {{ $employee->email }}</p>
                <p><strong>Department:</strong> {{ $employee->department->name }}</p>
                <p><strong>Gender:</strong>
                    <input type="radio" name="gender" value="Male" {{ $employee->gender==="Male"?'checked':'' }}>Male</input>
                    <input type="radio" name="gender" value="Female" {{ $employee->gender==="Female"?'checked':'' }}>Female</input>
                    <input type="radio" name="gender" value="Other" {{ ($employee->gender==="Other" || $employee->gender==="" || $employee->gender===null)?'checked':'' }}>Other</input>
                </p>
                <p><strong>Update Password</strong>
                <span>(only when neeed to change)</span>
                <div class="col-2">
                    <input type="password" class="form-control ml-1" name="update_password">
                </div>
                </p>
                <input type="submit" class="btn btn-outline-secondary"></input>
                
            </form>
        </div>
    </div>
@endsection
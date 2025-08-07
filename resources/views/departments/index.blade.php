@extends('layouts.app')

@section('title', 'Departments')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Departments</h2>
        <a href="{{ route('departments.create') }}" class="btn btn-primary">Add Department</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Departments</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($departments as $department)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $department->name }}</td>
                    <td>{{ $department->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">No departments found.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection

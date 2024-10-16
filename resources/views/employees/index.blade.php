@extends('app')

@section('content')
<div class="container">
    <h1>Employees</h1>
    <a href="{{ route('employees.create') }}" class="btn btn-primary my-3">Create Employee</a>

    @if (session('success'))
    <div id="success-alert" class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Company</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Profile Picture</th>
                    <th>Actions</th>
                </tr>
            </thead>
        <tbody>
            @if ($employees->isEmpty())
            <tr>
                <td colspan="7" class="text-center">No Employees found.</td>
            </tr>
            @else
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->company->name ?? 'N/A' }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>
                    @if(auth()->check() && $employee->profile_picture)
                    <img src="{{ route('employee.profile_picture', $employee) }}" alt="Profile Picture"
                        class="img-thumbnail">
                    @endif
                </td>
                <td>
                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>

    {{ $employees->links() }}
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this company?');
    }

    // Automatically hide the success alert after 3 seconds
    window.onload = function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            setTimeout(function() {
                alert.style.display = 'none';
            }, 3000); 
        }
    };
</script>

@endsection
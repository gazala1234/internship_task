@extends('app')

@section('content')
<div class="container">
    <h1>Companies</h1>

    <a href="{{ route('companies.create') }}" class="btn btn-primary my-3">Create Company</a>
    <a href="{{ route('employees.create') }}" class="btn btn-primary my-3">Create Employee</a>

    @if (session('success'))
    <div id="success-alert" class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if ($companies->isEmpty())
            <tr>
                <td colspan="5" class="text-center">No companies found.</td>
            </tr>
            @else
            @foreach ($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>
                    @if ($company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" width="50" height="50">
                    @else
                    No Logo
                    @endif
                </td>
                <td>{{ $company->website }}</td>
                <td>
                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline;"
                        onsubmit="return confirmDelete();">
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

    {{ $companies->links() }}
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
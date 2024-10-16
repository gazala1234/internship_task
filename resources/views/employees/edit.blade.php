
@extends('app')

@section('content')
<div class="container">
    <h1>Edit Employee</h1>
    <form action="{{ route('employees.update', $employee) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}" required>
        </div>

        <div class="form-group">
            <label for="company_id">Company</label>
            <select name="company_id" class="form-control" required>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ $company->id == $employee->company_id ? 'selected' : '' }}>
                        {{ $company->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $employee->email }}">
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="profile_picture" class="form-control" accept="image/*">
            @if ($employee->profile_picture)
                <img src="{{ asset('storage/' . $employee->profile_picture) }}" alt="Profile" width="50" height="50">
            @endif
        </div>

        <button type="submit" class="btn btn-primary my-3">Update</button>
    </form>
</div>
@endsection

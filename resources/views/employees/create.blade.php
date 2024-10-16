
@extends('app')

@section('content')
<div class="container">
    <h1>Create Employee</h1>
    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="company_id">Company</label>
            <select name="company_id" class="form-control" required>
                <option value="">Select a company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="profile_picture" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary my-3">Create</button>
    </form>
</div>
@endsection

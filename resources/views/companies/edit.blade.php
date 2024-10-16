<!-- resources/views/companies/edit.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>Edit Company</h1>
    <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $company->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $company->email }}">
        </div>

        <div class="form-group">
            <label for="logo">Logo (100x100 minimum)</label>
            <input type="file" name="logo" class="form-control" accept="image/*">
            @if ($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo" width="50" height="50">
            @endif
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" name="website" class="form-control" value="{{ $company->website }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

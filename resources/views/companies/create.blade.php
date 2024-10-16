<!-- resources/views/companies/create.blade.php -->

@extends('app')

@section('content')
<div class="container">
    <h1>Create Company</h1>
    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="form-group">
            <label for="logo">Logo (100x100 minimum)</label>
            <input type="file" name="logo" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" name="website" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection

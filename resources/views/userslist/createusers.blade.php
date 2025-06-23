@extends('layouts.app')

@section('title', 'Create User')

@section('contents')
<h1 class="mb-0">Add User</h1>
<hr />
<form action="{{ route('users_lists.store') }}" method="POST">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
        </div>
        <div class="col">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <input type="tel" name="phone_number" class="form-control" placeholder="Phone Number" required>
        </div>
        <div class="col">
            <input type="date" name="birth_date" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <select name="gender" class="form-control" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>
        <div class="col">
            <input type="text" name="sector" class="form-control" placeholder="Sector" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <textarea class="form-control" name="address" placeholder="Address" required></textarea>
        </div>
    </div>
    <div class="row">
        <div class="d-grid">
            <button type="submit" class="btn btn-dark">Submit</button>
        </div>
    </div>
</form>
@endsection
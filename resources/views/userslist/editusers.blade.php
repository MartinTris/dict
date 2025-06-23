@extends('layouts.app')

@section('title', 'Edit User')

@section('contents')
<h1 class="mb-0">Edit User</h1>
<hr />
<form action="{{ route('users_lists.update', ['users_list' => $users_list->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" value="{{ $users_list->full_name }}" required>
        </div>
        <div class="col mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $users_list->email }}" required>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Phone</label>
            <input type="tel" name="phone_number" class="form-control" value="{{ $users_list->phone_number }}" required>
        </div>
        <div class="col mb-3">
            <label class="form-label">Birth Date</label>
            <input type="date" name="birth_date" class="form-control" 
                   value="{{ \Carbon\Carbon::parse($users_list->birth_date)->format('Y-m-d') }}" required>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="Male" {{ $users_list->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $users_list->gender == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ $users_list->gender == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="col mb-3">
            <label class="form-label">Sector</label>
            <input type="text" name="sector" class="form-control" value="{{ $users_list->sector }}" required>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Address</label>
            <textarea class="form-control" name="address" required>{{ $users_list->address }}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="d-grid">
            <button class="btn btn-warning">Update</button>
        </div>
    </div>
</form>
@endsection

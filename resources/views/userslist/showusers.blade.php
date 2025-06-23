@extends('layouts.app')

@section('title', 'Show User')

@section('contents')
<h1 class="mb-0">User Details</h1>
<hr />
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" value="{{ $users_list->full_name }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Email</label>
        <input type="text" class="form-control" value="{{ $users_list->email }}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" class="form-control" value="{{ $users_list->phone_number }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Birth Date</label>
        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($users_list->birth_date)->format('Y-m-d') }}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Gender</label>
        <input type="text" class="form-control" value="{{ $users_list->gender }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Sector</label>
        <input type="text" class="form-control" value="{{ $users_list->sector }}" readonly>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Address</label>
        <textarea class="form-control" readonly>{{ $users_list->address }}</textarea>
    </div>
</div>
<div class="row">
    <div class="col mb-3">
        <label class="form-label">Created At</label>
        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($users_list->created_at)->format('Y-m-d H:i:s') }}" readonly>
    </div>
    <div class="col mb-3">
        <label class="form-label">Updated At</label>
        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($users_list->updated_at)->format('Y-m-d H:i:s') }}" readonly>
    </div>
</div>
@endsection

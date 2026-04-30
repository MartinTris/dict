@extends('layouts.app')

@section('title', 'Edit Leave Type')

@section('contents')
<div class="card shadow">
    <div class="card-body">
        <form method="POST" action="{{ route('leave-types.update', $leave_type) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Name</label>
                <input name="name" class="form-control" value="{{ $leave_type->name }}" required>
            </div>
            <div class="mb-3">
                <label>Slug</label>
                <input name="slug" class="form-control" value="{{ $leave_type->slug }}" required>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="is_active" class="form-check-input" @checked($leave_type->is_active)>
                <label class="form-check-label">Active</label>
            </div>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
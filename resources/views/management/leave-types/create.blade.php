@extends('layouts.app')

@section('title', 'Create Leave Type')

@section('contents')
<div class="card shadow">
    <div class="card-body">
        <form method="POST" action="{{ route('leave-types.store') }}">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input name="name" class="form-control" required>
            </div>
           
            <div class="form-check mb-3">
                <input type="checkbox" name="is_active" class="form-check-input" checked>
                <label class="form-check-label">Active</label>
            </div>
            <button class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection
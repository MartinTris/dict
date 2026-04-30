@extends('layouts.employee.app')

@section('title', 'Preview Leave Request')

@section('contents')
<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Review before submission</h5>
        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Type:</strong> {{ $type->name }}</li>
            <li class="list-group-item"><strong>Start:</strong> {{ \Carbon\Carbon::parse($data['start_date'])->format('M d, Y') }}</li>
            <li class="list-group-item"><strong>End:</strong> {{ \Carbon\Carbon::parse($data['end_date'])->format('M d, Y') }}</li>
            <li class="list-group-item"><strong>Days:</strong> {{ $days }}</li>
            <li class="list-group-item"><strong>Reason:</strong> {{ $data['reason'] ?? 'N/A' }}</li>
        </ul>

        <form method="POST" action="{{ route('employee.leaves.store') }}">
            @csrf
            <input type="hidden" name="leave_type_id" value="{{ $data['leave_type_id'] }}">
            <input type="hidden" name="start_date" value="{{ $data['start_date'] }}">
            <input type="hidden" name="end_date" value="{{ $data['end_date'] }}">
            <input type="hidden" name="reason" value="{{ $data['reason'] ?? '' }}">
            <input type="hidden" name="action" value="submit">
            <button class="btn btn-success">Submit Request</button>
            <a href="{{ route('employee.leaves.create') }}" class="btn btn-outline-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
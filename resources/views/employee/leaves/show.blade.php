@extends('layouts.employee.app')

@section('title', 'Leave Details')

@section('contents')
<div class="card shadow-sm">
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h5>{{ $leave->type->name }} Leave</h5>
        <p><strong>Dates:</strong> {{ $leave->start_date->format('M d, Y') }} - {{ $leave->end_date->format('M d, Y') }}</p>
        <p><strong>Days:</strong> {{ $leave->number_of_days }}</p>
        <p><strong>Status:</strong> {{ $leave->display_status }}</p>
        <p><strong>Reason:</strong> {{ $leave->reason ?? 'N/A' }}</p>

        <div class="d-flex gap-2 mt-3">
            @can('update', $leave)
                <a class="btn btn-primary" href="{{ route('employee.leaves.edit', $leave) }}">Edit</a>
            @endcan

            @can('cancel', $leave)
                <form method="POST" action="{{ route('employee.leaves.cancel', $leave) }}">
                    @csrf
                    <button class="btn btn-warning">Cancel Request</button>
                </form>
            @endcan

            <a class="btn btn-outline-secondary" href="{{ route('employee.leaves.download', $leave) }}">Download PDF</a>
        </div>
    </div>
</div>
@endsection
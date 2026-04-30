@extends('layouts.employee.app')

@section('title', 'Leave Dashboard')

@section('contents')
<div class="row">
    @foreach($balances as $balance)
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>{{ $balance->type->name }}</h6>
                    <p class="mb-1">Used: {{ $balance->used_days ?? 0 }} / {{ $balance->allocated_days }}</p>
                    @php
                        $percent = $balance->allocated_days > 0
                            ? round(($balance->used_days ?? 0) / $balance->allocated_days * 100)
                            : 0;
                    @endphp
                    <div class="progress">
                        <div class="progress-bar bg-info" style="width: {{ $percent }}%"></div>
                    </div>
                    <small class="text-muted">Remaining: {{ $balance->remaining_days }}</small>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="card shadow-sm mt-4">
    <div class="card-body">
        <h6 class="mb-3">Upcoming Leaves</h6>
        <ul class="list-group">
            @forelse($upcoming as $leave)
                <li class="list-group-item">
                    {{ $leave->type->name }} ({{ $leave->start_date->format('M d') }} - {{ $leave->end_date->format('M d') }})
                </li>
            @empty
                <li class="list-group-item text-muted">No upcoming leaves.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
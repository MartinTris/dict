@extends('layouts.employee.app')

@section('title', 'Employee Dashboard')

@section('contents')
<div class="row">
    <!-- Recent Leave -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Recent Leave Request
                        </div>
                        @if ($recentLeave)
                            <div class="h6 mb-1 font-weight-bold text-gray-800">
                                {{ $recentLeave->leaveType?->name ?? 'Leave' }}
                            </div>
                            <div class="text-muted small">
                                {{ $recentLeave->date_range }}
                            </div>
                            <span class="badge badge-pill badge-info mt-2">
                                {{ ucfirst($recentLeave->status) }}
                            </span>
                        @else
                            <div class="text-muted">No leave requests yet.</div>
                        @endif
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attendance Rate -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Attendance Rate (This Month)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $attendanceRate }}%
                        </div>
                        <div class="text-muted small">
                            {{ $workedCount }} / {{ $workdays }} workdays
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Leaves Used -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Leaves Used ({{ now('Asia/Manila')->year }})
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $leavesUsed }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-plane-departure fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- HR Documents -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-file-lines mr-2"></i>HR Documents
        </h6>
    </div>
    <div class="card-body">
        @if ($hrForms->isEmpty())
            <div class="text-muted">No HR forms available.</div>
        @else
            <ul class="list-group">
                @foreach ($hrForms as $form)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $form->title }}</strong>
                            <div class="text-muted small">
                                {{ $form->category?->name ?? 'Uncategorized' }}
                            </div>
                        </div>
                        <a href="{{ route('employee.hrforms.download', $form->id) }}"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-download mr-1"></i>Download
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>

<!-- Calendar of Activities -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-calendar-days mr-2"></i>Upcoming Activities
        </h6>
    </div>
    <div class="card-body">
        @if ($upcomingEvents->isEmpty())
            <div class="text-muted">No upcoming activities.</div>
        @else
            <ul class="list-group">
                @foreach ($upcomingEvents as $event)
                    <li class="list-group-item">
                        <strong>{{ $event->title }}</strong>
                        <div class="text-muted small">
                            {{ $event->start->format('M d, Y h:i A') }}
                            @if ($event->location) • {{ $event->location }} @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
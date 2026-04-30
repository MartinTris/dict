@extends('layouts.app')

@section('title', 'Leave Management')

@section('contents')
<div class="card shadow">
    <div class="card-body">
        <form class="row g-3 mb-3">
            <div class="col-md-2">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="pending" @selected(request('status')=='pending')>Pending</option>
                    <option value="approved" @selected(request('status')=='approved')>Approved</option>
                    <option value="rejected" @selected(request('status')=='rejected')>Rejected</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>From</label>
                <input type="date" name="from" class="form-control" value="{{ request('from') }}">
            </div>
            <div class="col-md-3">
                <label>To</label>
                <input type="date" name="to" class="form-control" value="{{ request('to') }}">
            </div>
            <div class="col-md-4">
                <label>Search Reason</label>
                <input type="text" name="search" class="form-control" value="{{ request('search') }}">
            </div>
            <div class="col-12">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('leave-management.index') }}" class="btn btn-outline-secondary">Reset</a>
                <a href="{{ route('leave-types.index') }}" class="btn btn-outline-success float-end">Manage Leave Types</a>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead style="background-color:#003566;color:white;">
                <tr>
                    <th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>Date Range</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaves as $leave)
                    <tr>
                        <td>{{ $leave->employee->name }}</td>
                        <td>{{ $leave->type->name }}</td>
                        <td>{{ $leave->start_date->format('M d, Y') }} - {{ $leave->end_date->format('M d, Y') }}</td>
                        <td>{{ $leave->reason }}</td>
                        <td>{{ ucfirst($leave->status) }}</td>
                        <td>{{ $leave->created_at->format('M d, Y') }}</td>
                        <td class="text-center">
                            @if($leave->status === 'pending')
                                <form method="POST" action="{{ route('leave-management.approve', $leave) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form method="POST" action="{{ route('leave-management.reject', $leave) }}" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            @else
                                <span class="text-muted">No Action</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">No leave requests found.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $leaves->links() }}
    </div>
</div>
@endsection
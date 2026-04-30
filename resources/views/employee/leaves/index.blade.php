@extends('layouts.employee.app')

@section('title', 'Leave History')

@section('contents')
<div class="card shadow-sm">
    <div class="card-body">
        <form class="row g-3 mb-3" method="GET">
            <div class="col-md-3">
                <label class="form-label">From</label>
                <input type="date" name="from" value="{{ request('from') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">To</label>
                <input type="date" name="to" value="{{ request('to') }}" class="form-control">
            </div>
            <div class="col-md-2">
                <label class="form-label">Type</label>
                <select name="leave_type_id" class="form-select">
                    <option value="">All</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" @selected(request('leave_type_id') == $type->id)>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="">All</option>
                    <option value="draft" @selected(request('status')=='draft')>Draft</option>
                    <option value="pending" @selected(request('status')=='pending')>Pending</option>
                    <option value="approved" @selected(request('status')=='approved')>Approved</option>
                    <option value="rejected" @selected(request('status')=='rejected')>Rejected</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Sort</label>
                <select name="sort" class="form-select">
                    <option value="latest" @selected(request('sort')=='latest')>Latest</option>
                    <option value="oldest" @selected(request('sort')=='oldest')>Oldest</option>
                    <option value="duration" @selected(request('sort')=='duration')>Duration</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Reason or type">
            </div>
            <div class="col-md-8 d-flex align-items-end gap-2">
                <button class="btn btn-primary">Filter</button>
                <a href="{{ route('employee.leaves.index') }}" class="btn btn-outline-secondary">Reset</a>
                <a href="{{ route('employee.leaves.create') }}" class="btn btn-success ms-auto">New Request</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Dates</th>
                        <th>Days</th>
                        <th>Status</th>
                        <th>Reason</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaves as $leave)
                        <tr>
                            <td>{{ $leave->type->name }}</td>
                            <td>{{ $leave->start_date->format('M d, Y') }} - {{ $leave->end_date->format('M d, Y') }}</td>
                            <td>{{ $leave->number_of_days }}</td>
                            <td><span class="badge bg-secondary">{{ $leave->display_status }}</span></td>
                            <td>{{ Str::limit($leave->reason, 50) }}</td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('employee.leaves.show', $leave) }}">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center text-muted">No leave requests found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $leaves->links() }}
    </div>
</div>
@endsection
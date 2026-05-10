@extends('layouts.app')

@section('title', 'Leave Request Details')

@section('contents')
<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fa-solid fa-file-lines mr-2"></i>Leave Request Details
                </h6>
                <span class="badge badge-pill badge-light">{{ ucfirst($leave->status) }}</span>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6 mb-2">
                        <div class="text-xs font-weight-bold text-uppercase text-muted">Employee</div>
                        <div class="h5 mb-0 text-gray-800">{{ $leave->user->name }}</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="text-xs font-weight-bold text-uppercase text-muted">Leave Type</div>
                        <div class="h5 mb-0 text-gray-800">{{ $leave->leaveType->name }}</div>
                    </div>
                    <div class="col-md-6 mb-2 mt-3">
                        <div class="text-xs font-weight-bold text-uppercase text-muted">Dates</div>
                        <div class="h6 mb-0 text-gray-800">{{ $leave->date_range }}</div>
                    </div>
                    <div class="col-md-6 mb-2 mt-3">
                        <div class="text-xs font-weight-bold text-uppercase text-muted">Number of Days</div>
                        <div class="h6 mb-0 text-gray-800">{{ $leave->number_of_days }}</div>
                    </div>
                </div>

                <hr>

                <div class="mb-4">
                    <div class="text-xs font-weight-bold text-uppercase text-muted">Reason</div>
                    <p class="mb-0 text-gray-700">{{ $leave->reason ?: '—' }}</p>
                </div>

                @if($leave->status === 'pending')
                <form method="POST" action="{{ route('admin.leaves.action', $leave) }}">
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">Admin Remarks (optional)</label>
                        <textarea name="admin_remarks" class="form-control" rows="3" placeholder="Add remarks if rejecting"></textarea>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-success" name="action" value="approve">
                            <i class="fa-solid fa-check mr-1"></i>Accept
                        </button>
                        <button class="btn btn-danger" name="action" value="reject">
                            <i class="fa-solid fa-xmark mr-1"></i>Decline
                        </button>
                    </div>
                </form>
                @else
                <div class="alert alert-info mb-0">
                    This request is already {{ $leave->status }}.
                </div>
                @endif
            </div>
        </div>

        <a href="{{ route('admin.leaves.index') }}" class="btn btn-light">
            <i class="fa-solid fa-arrow-left mr-1"></i>Back to Leave Management
        </a>
    </div>
</div>
@endsection
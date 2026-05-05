@extends('layouts.employee.app')

@section('title', 'Leave Details')

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
                        <div class="text-xs font-weight-bold text-uppercase text-muted">Leave Type</div>
                        <div class="h5 mb-0 text-gray-800">{{ $leave->leaveType->name }}</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="text-xs font-weight-bold text-uppercase text-muted">Status</div>
                        <div class="h5 mb-0 text-gray-800">
                            <span class="badge badge-{{ in_array($leave->status, ['approved']) ? 'success' : (in_array($leave->status, ['pending']) ? 'warning' : 'secondary') }}">
                                {{ ucfirst($leave->status) }}
                            </span>
                        </div>
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
                    <p class="mb-0 text-gray-700">{{ $leave->reason }}</p>
                </div>

                @if(in_array($leave->status, ['pending','approved']))
                <form method="POST" action="{{ route('employee.leaves.cancel', $leave) }}">
                    @csrf
                    <button class="btn btn-danger">
                        <i class="fa-solid fa-ban mr-1"></i>Cancel Request
                    </button>
                </form>
                @endif
            </div>
        </div>

        <a href="{{ route('employee.leaves.index') }}" class="btn btn-light">
            <i class="fa-solid fa-arrow-left mr-1"></i>Back to My Leaves
        </a>
    </div>
</div>
@endsection
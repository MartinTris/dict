@extends('layouts.employee.app')

@section('title', 'My Leaves')

@section('contents')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fa-solid fa-clipboard-list mr-2"></i>Leave History
                </h6>
                <a href="{{ route('employee.leaves.create') }}" class="btn btn-sm" style="color: white; background-color: #003566">
                    <i class="fa-solid fa-plus mr-1"></i>Request Leave
                </a>
            </div>
            <div class="card-body">
                <form method="GET" class="mb-4">
                    <div class="form-row align-items-end">
                        <div class="form-group col-md-3">
                            <label class="font-weight-bold text-gray-700">Status</label>
                            <select name="status" class="form-control">
                                <option value="">All Statuses</option>
                                @foreach(['draft','pending','approved','rejected','cancelled'] as $s)
                                    <option value="{{ $s }}">{{ ucfirst($s) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="font-weight-bold text-gray-700">Leave Type</label>
                            <select name="leave_type_id" class="form-control">
                                <option value="">All Types</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold text-gray-700">Search Reason</label>
                            <input name="search" class="form-control" placeholder="Search reason">
                        </div>
                        <div class="form-group col-md-2">
                            <button class="btn btn-primary btn-block">
                                <i class="fa-solid fa-filter mr-1"></i>Filter
                            </button>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th>Type</th>
                                <th>Dates</th>
                                <th>Days</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leaves as $leave)
                            <tr>
                                <td>{{ $leave->leaveType->name }}</td>
                                <td>{{ $leave->date_range }}</td>
                                <td>{{ $leave->number_of_days }}</td>
                                <td>
                                    <span class="badge badge-{{ in_array($leave->status, ['approved']) ? 'success' : (in_array($leave->status, ['pending']) ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($leave->status) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('employee.leaves.show', $leave) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fa-regular fa-eye mr-1"></i>View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    {{ $leaves->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
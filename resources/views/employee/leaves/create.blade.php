@extends('layouts.employee.app')

@section('title', 'Request Leave')

@section('contents')
<div class="row justify-content-center">
    <div class="col-xl-8 col-lg-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fa-solid fa-calendar-plus mr-2"></i>Leave Request Form
                </h6>
                <span class="badge badge-pill badge-light">Employee Portal</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('employee.leaves.store') }}">
                    @csrf

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">Leave Type</label>
                        <select name="leave_type_id" class="form-control" required>
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold text-gray-700">Start Date</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold text-gray-700">End Date</label>
                            <input type="date" name="end_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold text-gray-700">Reason</label>
                        <textarea name="reason" class="form-control" rows="4" placeholder="Optional details about your request"></textarea>
                    </div>

                    <div class="d-flex flex-wrap gap-2 justify-content-end">
                        <button class="btn btn-primary" name="action" value="submit">
                            <i class="fa-solid fa-paper-plane mr-1"></i>Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
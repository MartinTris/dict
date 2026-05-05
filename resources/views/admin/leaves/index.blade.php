@extends('layouts.app')
@section('title', 'Leave Management')
@section('contents')
<h1>Leave Management</h1>

<form method="GET">
    <select name="status">
        <option value="">All Status</option>
        @foreach(['pending','approved','rejected'] as $s)
            <option value="{{ $s }}">{{ ucfirst($s) }}</option>
        @endforeach
    </select>
    <select name="leave_type_id">
        <option value="">All Types</option>
        @foreach($types as $type)
            <option value="{{ $type->id }}">{{ $type->name }}</option>
        @endforeach
    </select>
    <select name="employee_id">
        <option value="">All Employees</option>
        @foreach($employees as $emp)
            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
        @endforeach
    </select>
    <input name="search" placeholder="Search name/reason">
    <button>Filter</button>
</form>

<table>
    <tr>
        <th>Employee</th>
        <th>Type</th>
        <th>Dates</th>
        <th>Days</th>
        <th>Status</th>
        <th></th>
    </tr>
    @foreach($leaves as $leave)
    <tr>
        <td>{{ $leave->user->name }}</td>
        <td>{{ $leave->leaveType->name }}</td>
        <td>{{ $leave->date_range }}</td>
        <td>{{ $leave->number_of_days }}</td>
        <td>{{ ucfirst($leave->status) }}</td>
        <td><a href="{{ route('admin.leaves.show', $leave) }}">View</a></td>
    </tr>
    @endforeach
</table>

{{ $leaves->links() }}
@endsection
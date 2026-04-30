@extends('layouts.app')

@section('title', 'Leave Types')

@section('contents')
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('leave-types.create') }}" class="btn btn-primary">Add Leave Type</a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead style="background-color:#003566;color:white;">
                <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leaveTypes as $type)
                    <tr>
                        <td>{{ $type->name }}</td>
                        <td>{{ $type->slug }}</td>
                        <td>{{ $type->is_active ? 'Active' : 'Inactive' }}</td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-warning" href="{{ route('leave-types.edit', $type) }}">Edit</a>
                            <form method="POST" action="{{ route('leave-types.destroy', $type) }}" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">No leave types found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
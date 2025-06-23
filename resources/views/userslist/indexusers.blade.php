@extends('layouts.app')

@section('title', 'Users List')

@section('contents')
<div class="d-flex align-items-center justify-content-between">
    <h1 class="mb-0">Users List</h1>
    <a href="{{ route('users_lists.create') }}" class="btn btn-primary">Add User</a>
</div>
<hr />

@if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
@endif

<table class="table table-hover">
    <thead class="table-primary">
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Birth Date</th>
            <th>Gender</th>
            <th>Sector</th> {{-- ✅ Added Sector Column --}}
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if($users->count() > 0)
            @foreach($users as $rs)  {{-- Use $users instead of $users_lists --}}
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $rs->full_name }}</td>
                    <td class="align-middle">{{ $rs->email }}</td>
                    <td class="align-middle">{{ $rs->phone_number }}</td>
                    <td class="align-middle">{{ \Carbon\Carbon::parse($rs->birth_date)->format('Y-m-d') }}</td>
                    <td class="align-middle">{{ $rs->gender }}</td>
                    <td class="align-middle">{{ $rs->sector }}</td> {{-- ✅ Added Sector Value --}}
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('users_lists.show', $rs->id) }}" class="btn btn-secondary">Detail</a>
                            <a href="{{ route('users_lists.edit', $rs->id)}}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('users_lists.destroy', $rs->id) }}" method="POST" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger m-0">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="8">No users found</td> {{-- ✅ Updated colspan to 8 --}}
            </tr>
        @endif
    </tbody>
</table>
@endsection

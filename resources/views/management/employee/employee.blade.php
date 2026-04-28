@extends('layouts.app')

@section('title', 'Employee Management')

@section('contents')
    <div class="container-fluid">
        <div class="d-flex justify-content-end mb-3">
                {{-- route('employee.create') --}}
                <a href="#" class="btn btn-primary" style="background-color: #003566; border-color: #003566;">
                    <i class="fas fa-plus-circle"></i> ADD RECORD
                </a>
        </div>
        <div class="card shadow">
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead style="background-color: #003566; color: white;">
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>LOCATIONS</th>
                                <th>OPERATIONS</th>
                                <th>STATUS</th>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--@forelse($ibplsRecords as $record)
                            <tr>
                               <!-- <td>{{ $record->id }}</td> -->
                                <td>{{ $record->location }}</td>
                                <td>{{ $record->operation }}</td>
                                <td>{{ $record->status }}</td>
                                <td class="text-center">
                                    <a href="{{ route('ibpls.show', $record->id)}} " class="btn btn-sm btn-dark">Detail</a>
                                    <a href="{{ route('ibpls.edit', $record->id)}}" class="btn btn-sm btn-warning">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDelete('{{ $record->id }}')">Delete</button>
                                </td>
                            </tr>
                            @empty--}}
                            <tr>
                                <td colspan="5" class="text-center">No records found</td>
                            </tr>
                            {{--@endforelse--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

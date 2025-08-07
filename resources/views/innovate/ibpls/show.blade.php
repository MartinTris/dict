@extends('layouts.app')

@section('title', 'IBPLS Details')

@section('contents')
    <div class="container-fluid">
        <div class="mb-4">
            <div class="py-3 d-flex justify-content-end align-items-center flex-wrap gap-2">
                <div>
                    <a href="{{ url('/ibpls/' . $ibpls->id . '/edit') }}" class="btn btn-sm btn-primary edit-btn mx-1"
                        style="background-color:#003566; border:none" data-bs-toggle="modal" data-bs-target="#editSiteModal"
                        data-ibpls='@json($ibpls)'>
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ url('/ibpls') }}" class="btn btn-sm btn-secondary mx-1"
                        style="background-color:#6a84a0; border:none">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>

                </div>
            </div>
            <div class="card shadow">
                <div class="card-header" style="background-color: #003566; color: white;">
                    <h5 class="m-0 font-weight-bold">IBPLS Record Details</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <!-- Remove this row to hide ID
                                    <tr>
                                        <th style="width: 200px; background-color: #e9ecef;">ID</th>
                                        <td>{{ $ibpls->id }}</td>
                                    </tr>
                                    -->

                            <tr>
                                <th style="background-color: #e9ecef;">Location</th>
                                <td>{{ $ibpls->location }}</td>
                            </tr>
                            <tr>
                                <th style="background-color: #e9ecef;">District</th>
                                <td>{{ $ibpls->district }}</td>
                            </tr>
                            <tr>
                                <th style="background-color: #e9ecef;">Operation</th>
                                <td>{{ $ibpls->operation }}</td>
                            </tr>
                            <tr>
                                <th style="background-color: #e9ecef;">Status</th>
                                <td>{{ $ibpls->status ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th style="background-color: #e9ecef;">Created At</th>
                                <td>{{ $ibpls->created_at->format('F d, Y h:i A') }}</td>
                            </tr>
                            <tr>
                                <th style="background-color: #e9ecef;">Updated At</th>
                                <td>{{ $ibpls->updated_at->format('F d, Y h:i A') }}</td>
                            </tr>
                        </table>
                        <div class="mt-3 d-flex justify-content-end">
                            <button type="button" class="d-inline delete-form btn btn-danger"
                                onclick="confirmDelete('{{ $ibpls->id }}')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #003566; color: white;">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this record?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form id="deleteForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function confirmDelete(id) {
                document.getElementById('deleteForm').action = `/ibpls/${id}`;
                $('#deleteModal').modal('show');
            }
        </script>
    @endsection

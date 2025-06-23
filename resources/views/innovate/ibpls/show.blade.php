@extends('layouts.app')

@section('title', 'IBPLS Details')

@section('contents')
<div class="container-fluid">
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
            </div>
            
            <div class="mt-3">
                <a href="{{ url('/ibpls') }}" class="btn btn-secondary">Back to List</a>
                <a href="{{ url('/ibpls/'.$ibpls->id.'/edit') }}" class="btn btn-warning">Edit</a>
                <button type="button" class="btn btn-danger" 
                    onclick="confirmDelete('{{ $ibpls->id }}')">Delete</button>
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
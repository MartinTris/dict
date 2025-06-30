@extends('layouts.app')

@section('contents')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="font-weight-bold">IBPLS Management</h2>
        <div>
            <a href="{{ route('ibpls.create') }}" class="btn btn-primary" style="background-color: #003566; border-color: #003566;">
                <i class="fas fa-plus-circle"></i> ADD RECORD
            </a>
            <a href="{{ route('ibpls.visualization') }}" class="btn btn-info" style="background-color: #003566; border-color: #003566; color: white;">
                <i class="fas fa-chart-bar"></i> Data Visualization
            </a>
        </div>
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
                        @forelse($ibplsRecords as $record)
                        <tr>
                           <!-- <td>{{ $record->id }}</td> -->
                            <td>{{ $record->location }}</td>
                            <td>{{ $record->operation }}</td>
                            <td>{{ $record->status }}</td>
                            <td class="text-center">
                                <a href="{{ route('ibpls.show', $record->id) }}" class="btn btn-sm" style="background-color: #4657a2; color: #fff;">Detail</a>
                                <a href="{{ route('ibpls.edit', $record->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger" 
                                    onclick="confirmDelete('{{ $record->id }}')">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No records found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
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

    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

</script>
@endsection
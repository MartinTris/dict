@extends('layouts.app')
  
@section('contents')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">TECH4ED Centers</h1>
            <div>
                <a href="{{ route('tech4ed.create') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                    <i class="fas fa-plus"></i> Add New Center
                </a>
                <a href="{{ route('tech4ed.visualization') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                    <i class="fas fa-chart-bar"></i> Data Visualization
                </a>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background-color: #003566; color: white;">
                <h6 class="m-0 font-weight-bold">TECH4ED Centers List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="min-width: 155px;">Congressional District</th>
                                <th style="min-width: 150px;">Municipality</th>
                                <th style="min-width: 200px;">Specific Center Location</th>
                                <th style="min-width: 180px;">Center Name</th>
                                <th style="min-width: 150px;">Center Model</th>
                                <th style="min-width: 180px;">CM Name</th>
                                <th style="min-width: 180px;">CM Email</th>
                                <th style="min-width: 150px;">CM Mobile</th>
                                <th style="min-width: 100px;">CM Sex</th>
                                <th style="min-width: 150px;">Date of Launching</th>
                                <th style="min-width: 120px;">Operational</th>
                                <th style="min-width: 140px;">With Donation</th>
                                <th style="min-width: 150px;">Type of Donation</th>
                                <th style="min-width: 150px; width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tech4eds as $tech4ed)
                            <tr>
                                <td>{{ $tech4ed->congressional_district }}</td>
                                <td>{{ $tech4ed->municipality }}</td>
                                <td>{{ $tech4ed->specific_center_location }}</td>
                                <td>{{ $tech4ed->center_name }}</td>
                                <td>{{ $tech4ed->center_model }}</td>
                                <td>{{ $tech4ed->cm_name }}</td>
                                <td>{{ $tech4ed->cm_email }}</td>
                                <td>{{ $tech4ed->cm_mobile }}</td>
                                <td>{{ $tech4ed->cm_sex }}</td>
                                <td>{{ date('F d, Y', strtotime($tech4ed->date_of_launching)) }}</td>
                                <td>{{ $tech4ed->operational }}</td>
                                <td>{{ $tech4ed->with_donation }}</td>
                                <td>{{ $tech4ed->type_of_donation ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <form action="{{ route('tech4ed.destroy', $tech4ed->id) }}" method="POST" class="d-flex justify-content-around">
                                        <a href="{{ route('tech4ed.show', $tech4ed->id) }}" class="btn btn-info btn-sm mr-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('tech4ed.edit', $tech4ed->id) }}" class="btn btn-primary btn-sm mr-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this center?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Add additional styling for formal appearance */
        #dataTable {
            font-family: Arial, sans-serif;
        }
        
        #dataTable thead {
            background-color: #f8f9fc;
        }
        
        #dataTable thead th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.03em;
            vertical-align: middle;
            border-bottom: 2px solid #e3e6f0;
        }
        
        #dataTable tbody td {
            vertical-align: middle;
            padding: 0.75rem;
            font-size: 0.9rem;
        }
        
        /* Better spacing for action buttons */
        form.d-flex .btn {
            margin: 0 2px;
        }
    </style>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "scrollX": true,
                "autoWidth": false,
                "columnDefs": [
                    { "width": "150px", "targets": -1 } // Fix width for actions column
                ],
                "language": {
                    "lengthMenu": "Display _MENU_ records per page",
                    "zeroRecords": "No records found",
                    "info": "Showing page _PAGE_ of _PAGES_",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)"
                }
            });
        });
    </script>
@endsection
@extends('layouts.app')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Cybersecurity Advocacies</h1>
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">Cybersecurity Records</h6>
                <div>
                    <a href="{{ route('cybersecurity.create') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                        <i class="fas fa-plus"></i> Add New Record
                    </a>
                    <a href="{{ route('cybersecurity.visualization') }}" class="btn btn-sm" style="background-color: #003566; color: white;">
                        <i class="fas fa-chart-bar"></i> Data Visualization
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" style="min-width: 120px;">Date Conducted</th>
                                <th class="text-center" style="min-width: 150px;">Time Conducted</th>
                                <th class="text-center" style="min-width: 150px;">Organizer</th>
                                <th class="text-center" style="min-width: 120px;">Province</th>
                                <th class="text-center" style="min-width: 200px;">Activity Title</th>
                                <th class="text-center" style="min-width: 170px;">Type of Activity</th>
                                <th class="text-center" style="min-width: 180px;">Mode of Implementation</th>
                                <th class="text-center" style="min-width: 100px;">Zoom Link</th>
                                <th class="text-center" style="min-width: 90px;">Male Participants</th>
                                <th class="text-center" style="min-width: 90px;">Female Participants</th>
                                <th class="text-center" style="min-width: 80px;">Total</th>
                                <th class="text-center" style="min-width: 150px;">Resource Person</th>
                                <th class="text-center" style="min-width: 100px;">FB Posting</th>
                                <th class="text-center" style="min-width: 110px;">Engagement</th>
                                <th class="text-center" style="min-width: 130px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cybersecurityRecords ?? [] as $record)
                                <tr>
                                    <td class="text-center">{{ date('M d, Y', strtotime($record->date_conducted)) }}</td>
                                    <td class="text-center">{{ $record->time_conducted }}</td>
                                    <td>{{ $record->organizer }}</td>
                                    <td>{{ $record->province }}</td>
                                    <td>{{ $record->activity_title }}</td>
                                    <td>{{ $record->type_of_activity }}</td>
                                    <td>{{ $record->mode_of_implementation }}</td>
                                    <td class="text-center">
                                        @if($record->zoom_link)
                                            <a href="{{ $record->zoom_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-link"></i> Link
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $record->male_participants }}</td>
                                    <td class="text-center">{{ $record->female_participants }}</td>
                                    <td class="text-center font-weight-bold">{{ $record->male_participants + $record->female_participants }}</td>
                                    <td>{{ $record->resource_person }}</td>
                                    <td class="text-center">
                                        @if($record->fb_posting)
                                            <a href="{{ $record->fb_posting }}" target="_blank" class="btn btn-sm btn-outline-info">
                                                <i class="fab fa-facebook"></i> View
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $record->number_of_engagement ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('cybersecurity.show', $record->id) }}" class="btn btn-sm btn-info mx-1" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('cybersecurity.edit', $record->id) }}" class="btn btn-sm btn-primary mx-1" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('cybersecurity.destroy', $record->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger mx-1" 
                                                    onclick="return confirm('Are you sure you want to delete this record?')" 
                                                    title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="15" class="text-center">No Cybersecurity records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTables for better table functionality if you have jQuery and DataTables
            if (typeof $.fn.dataTable !== 'undefined') {
                $('#dataTable').DataTable({
                    "scrollX": true,
                    "autoWidth": false,
                    "responsive": false, // Disable responsive behavior to maintain min-widths
                    "pageLength": 10,
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "order": [[0, "desc"]], // Sort by date descending by default
                });
            }
        });
    </script>

    <style>
        /* Additional styling for better table appearance */
        .table th {
            background-color: #003566;
            color: white;
            font-weight: bold;
            white-space: nowrap;
            vertical-align: middle;
            padding: 10px;
        }
        
        .table td {
            vertical-align: middle;
            padding: 8px;
        }
        
        /* Add hover effect for rows */
        .table-striped tbody tr:hover {
            background-color: rgba(0, 53, 102, 0.05);
        }
        
        /* Prevent column compression */
        #dataTable {
            table-layout: auto;
            width: 100%;
        }
        
        /* Ensure proper horizontal scrolling */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            min-height: 0.01%;
        }
        
        /* Make action buttons look better */
        .btn-group .btn {
            margin: 0 2px;
        }
        
        /* Ensure consistent text alignment */
        .text-center {
            text-align: center !important;
        }
    </style>
@endsection
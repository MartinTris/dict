@extends('layouts.app')
@section('contents')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">FW4A Management</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold" style="color: #003566;">FW4A Sites</h6>
                <div>
                    <a href="{{--route('pnpki.create')--}}" class="btn btn-sm"
                        style="background-color: #003566; color: white;">
                        <i class="fas fa-plus"></i> Add New Record
                    </a>
                    <a href="{{--route('pnpki.visualization')--}}" class="btn btn-sm"
                        style="background-color: #003566; color: white;">
                        <i class="fas fa-chart-bar"></i> Data Visualization
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" style="min-width: 120px;">Site Code</th>
                                <th class="text-center" style="min-width: 120px;">Site Name</th>
                                <th class="text-center" style="min-width: 120px;">Region</th>
                                <th class="text-center" style="min-width: 120px;">Province</th>
                                <th class="text-center" style="min-width: 220px;">Congressional District</th>
                                <th class="text-center" style="min-width: 120px;">Locality</th>
                                <th class="text-center" style="min-width: 180px;">Contract Status</th>
                                <th class="text-center" style="min-width: 120px;">Contract</th>
                                <th class="text-center" style="min-width: 120px;">Category</th>
                                <th class="text-center" style="min-width: 120px;">Contractor</th>
                                <th class="text-center" style="min-width: 120px;">Latitude</th>
                                <th class="text-center" style="min-width: 120px;">Longitude</th>
                                <th class="text-center" style="min-width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--@forelse ($pnpkis ?? [] as $pnpki)
                            <tr>
                                <td class="text-center">{{$pnpki->date_conducted }}</td>
                                <td class="text-center">{{ $pnpki->time_conducted }}</td>
                                <td>{{ $pnpki->organizer }}</td>
                                <td>{{ $pnpki->province }}</td>
                                <td>{{ $pnpki->activity_title }}</td>
                                <td>{{ $pnpki->type_of_activity }}</td>
                                <td>{{ $pnpki->mode_of_implementation }}</td>
                                {{--<td class="text-center">
                                    @if($pnpki->zoom_link)
                                    <a href="{{ $pnpki->zoom_link }}" target="_blank"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-link"></i> Link
                                    </a>
                                    @else
                                    <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $pnpki->male_participants }}</td>
                                <td class="text-center">{{ $pnpki->female_participants }}</td>
                                <td class="text-center font-weight-bold">{{ $pnpki->total_participants }}</td>
                                <td>{{ $pnpki->resource_person }}</td>
                                {{--<td class="text-center">
                                    @if($pnpki->fb_posting)
                                    <a href="{{ $pnpki->fb_posting }}" target="_blank" class="btn btn-sm btn-outline-info">
                                        <i class="fab fa-facebook"></i> View
                                    </a>
                                    @else
                                    <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $pnpki->number_of_engagement ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{--route('pnpki.show', $pnpki->id)}}" class="btn btn-sm btn-info mx-1"
                                            title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{--route('pnpki.edit', $pnpki->id)}}" class="btn btn-sm btn-primary mx-1"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{--route('pnpki.destroy', $pnpki->id)}}" method="POST"
                                            class="d-inline">
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
                                <td colspan="15" class="text-center">No PNPKI records found.</td>
                            </tr>
                            @endforelse --}}
                        </tbody>
                    </table>
                    {{--
                    @if (isset($pnpkis) && $pnpkis->count() > 0)
                    <div class="d-flex justify-content-end mt-3">
                    </div>
                    @endif--}}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
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
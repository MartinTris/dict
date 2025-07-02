@extends('layouts.app')
@include('connect.fw4a.create')
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
                    <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addSiteModal"
                        style="background-color: #003566; color: white;">
                        <i class="fas fa-plus"></i> Add New Site
                    </button>

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
                        <tbody></tbody>
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